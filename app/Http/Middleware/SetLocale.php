<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * The URL is the single source of truth for locale: /kn/faqs is Kannada,
 * /faqs is English. Nothing is stored in the session, so every page has one
 * canonical address that Google can index per language.
 *
 * ?lang=xx is still honoured — it 301s to the equivalent prefixed URL — so old
 * links and anything already shared keep working.
 */
class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $supported = array_keys(config('site.locales', ['en' => 'English']));

        // Legacy ?lang=xx → permanent redirect to the prefixed URL.
        if ($request->has('lang')) {
            $requested = (string) $request->query('lang');
            $target = $request->fullUrlWithoutQuery('lang');

            if (in_array($requested, $supported, true)) {
                $target = $this->withLocale($target, $requested, $supported);
            }

            return redirect()->to($target, 301);
        }

        // First path segment wins, otherwise English.
        $segment = $request->segment(1);
        $locale = ($segment !== 'en' && in_array($segment, $supported, true)) ? $segment : 'en';

        app()->setLocale($locale);

        return $next($request);
    }

    /**
     * Rewrite a URL's locale prefix — strips any existing one, then adds the
     * new one (English keeps the bare path).
     */
    private function withLocale(string $url, string $locale, array $supported): string
    {
        $parts = parse_url($url);
        $path = trim($parts['path'] ?? '/', '/');
        $segments = $path === '' ? [] : explode('/', $path);

        if (isset($segments[0]) && in_array($segments[0], $supported, true) && $segments[0] !== 'en') {
            array_shift($segments);
        }

        if ($locale !== 'en') {
            array_unshift($segments, $locale);
        }

        $base = ($parts['scheme'] ?? 'https').'://'.($parts['host'] ?? request()->getHost());

        if (isset($parts['port'])) {
            $base .= ':'.$parts['port'];
        }

        return $base.'/'.implode('/', $segments).(isset($parts['query']) ? '?'.$parts['query'] : '');
    }
}
