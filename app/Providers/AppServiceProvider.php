<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Guard against lazy-loading N+1 surprises and silent attribute drops
        // outside production.
        Model::shouldBeStrict(! $this->app->isProduction());

        // Use immutable Carbon dates app-wide.
        Date::use(\Carbon\CarbonImmutable::class);
    }
}
