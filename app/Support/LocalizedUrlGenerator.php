<?php

namespace App\Support;

use Illuminate\Routing\UrlGenerator;

/**
 * Makes route() locale-aware so views never have to pass a locale.
 *
 * routes/web.php registers each public page twice: once unprefixed for English
 * ("faqs") and once per locale behind a prefix ("kn.faqs"). This resolves
 * route('faqs') to "kn.faqs" whenever the active locale has its own copy, which
 * is why none of the ~50 route() calls in the views needed editing.
 *
 * Names with no localized twin — Filament's admin panel, Livewire, anything
 * already carrying a locale prefix — fall straight through to the parent.
 */
class LocalizedUrlGenerator extends UrlGenerator
{
    public function route($name, $parameters = [], $absolute = true)
    {
        $locale = app()->getLocale();

        if ($locale !== 'en' && is_string($name) && ! str_starts_with($name, $locale.'.')) {
            $localized = $locale.'.'.$name;

            if ($this->routes->hasNamedRoute($localized)) {
                $name = $localized;
            }
        }

        return parent::route($name, $parameters, $absolute);
    }

    /**
     * Build a URL for an explicit locale, given an unprefixed route name.
     *
     * Goes straight to the parent so the rewrite above can't fire a second
     * time — that would turn a request for the English "faqs" into "kn.faqs"
     * while Kannada is active. Returns null when the locale has no such route.
     */
    public function routeForLocale(string $locale, string $name, $parameters = [], bool $absolute = true): ?string
    {
        $target = $locale === 'en' ? $name : $locale.'.'.$name;

        return $this->routes->hasNamedRoute($target)
            ? parent::route($target, $parameters, $absolute)
            : null;
    }
}
