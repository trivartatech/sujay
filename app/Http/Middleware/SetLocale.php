<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Locale is chosen with ?lang=xx (from the header switcher) and remembered in
 * the session. URLs are unchanged, so existing links and SEO stay intact.
 */
class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $supported = array_keys(config('site.locales', ['en' => 'English']));

        // ?lang=xx switches and is then stripped from the URL
        if ($request->has('lang')) {
            $requested = (string) $request->query('lang');

            if (in_array($requested, $supported, true)) {
                session(['locale' => $requested]);
            }

            return redirect()->to($request->fullUrlWithoutQuery('lang'));
        }

        $locale = session('locale');
        app()->setLocale(in_array($locale, $supported, true) ? $locale : 'en');

        return $next($request);
    }
}
