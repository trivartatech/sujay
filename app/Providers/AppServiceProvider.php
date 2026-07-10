<?php

namespace App\Providers;

use App\Models\LibrarySection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
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
