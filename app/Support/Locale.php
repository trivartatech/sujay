<?php

namespace App\Support;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class Locale
{
    /**
     * Whether the public site advertises its other languages — the header
     * picker, the hreflang tags and the multi-locale sitemap.
     *
     * The /kn/… routes stay live regardless; this only controls whether we
     * point visitors and crawlers at them.
     */
    public static function switcherEnabled(): bool
    {
        return (bool) config('site.language_switcher', false);
    }

    /** Whether the admin panel exposes per-language content editing. */
    public static function contentTranslationsEnabled(): bool
    {
        return (bool) config('site.content_translations', false);
    }

    /**
     * Locales offered on the admin content screens.
     *
     * English only while the feature is off, which collapses the panel back to
     * a single language. Stored translations in other locales are untouched and
     * the public site still serves them.
     *
     * @return list<string>
     */
    public static function adminLocales(): array
    {
        if (! self::contentTranslationsEnabled()) {
            return ['en'];
        }

        return array_keys(config('site.locales', ['en' => 'English']));
    }

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
