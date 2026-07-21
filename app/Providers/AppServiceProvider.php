<?php

namespace App\Providers;

use App\Models\LibrarySection;
use App\Support\LocalizedUrlGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Swap in the locale-aware URL generator so route('faqs') resolves to
        // the current locale's copy of the route. Mirrors the wiring Laravel's
        // own RoutingServiceProvider does, using only public setters.
        $this->app->extend('url', function (UrlGenerator $url, $app) {
            $new = new LocalizedUrlGenerator(
                $app['routes'],
                $app['request'],
                $app['config']['app.asset_url'],
            );

            $new->setSessionResolver(fn () => $app['session'] ?? null);
            $new->setKeyResolver(fn () => $app['config']['app.key']);

            $app->rebinding('request', fn ($app, $request) => $app['url']->setRequest($request));
            $app->rebinding('routes', fn ($app, $routes) => $app['url']->setRoutes($routes));

            return $new;
        });
    }

    public function boot(): void
    {
        // Guard against lazy-loading N+1 surprises and silent attribute drops
        // outside production.
        Model::shouldBeStrict(! $this->app->isProduction());

        // Use immutable Carbon dates app-wide.
        Date::use(\Carbon\CarbonImmutable::class);

        // Custom, dependency-free pagination markup (matches public/css/app.css).
        Paginator::defaultView('partials.pagination');

        // The "Heart Health Library" dropdown in the header. Cached because it
        // renders on every page; LibrarySection busts the key on save/delete.
        View::composer('partials.header', function ($view) {
            $view->with('navSections', Cache::remember(
                LibrarySection::NAV_CACHE_KEY,
                now()->addHours(6),
                fn () => LibrarySection::published()
                    ->orderBy('sort_order')
                    ->get(['id', 'title', 'slug']),
            ));
        });
    }
}
