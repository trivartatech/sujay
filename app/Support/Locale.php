<?php

namespace App\Support;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class Locale
{
    /**
     * The current page's address in every locale, keyed by locale code.
     *
     * Feeds both the header language switcher and the hreflang tags, so the
     * two can never disagree about where a translation lives.
     */
    public static function alternates(): array
    {
        $supported = array_keys(config('site.locales', ['en' => 'English']));
        $current = Route::current();

        // No matched route (404s, for one) — offer the home page instead.
        $name = $current?->getName();
        $parameters = $current?->parameters() ?? [];

        if ($name === null) {
            $name = 'home';
            $parameters = [];
        }

        // "kn.faqs" → "faqs"
        $base = $name;
        foreach ($supported as $locale) {
            if ($locale !== 'en' && str_starts_with($name, $locale.'.')) {
                $base = substr($name, strlen($locale) + 1);
                break;
            }
        }

        $alternates = [];

        foreach ($supported as $locale) {
            $url = URL::routeForLocale($locale, $base, $parameters);

            if ($url !== null) {
                $alternates[$locale] = $url;
            }
        }

        return $alternates;
    }
}
