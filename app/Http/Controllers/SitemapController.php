<?php

namespace App\Http\Controllers;

use App\Models\LibraryArticle;
use App\Models\LibrarySection;
use App\Models\Post;
use App\Models\Procedure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $entries = [];

        // Static pages
        $static = ['home', 'about', 'philosophy', 'services.index', 'library.index', 'faqs', 'blog.index', 'contact', 'appointment.create'];
        foreach ($static as $name) {
            $entries[] = ['route' => $name, 'priority' => $name === 'home' ? '1.0' : '0.7'];
        }

        // Services
        foreach (Procedure::published()->get() as $procedure) {
            $entries[] = [
                'route' => 'services.show',
                'params' => [$procedure],
                'lastmod' => $procedure->updated_at?->toAtomString(),
                'priority' => '0.8',
            ];
        }

        // Heart Health Library sections + their articles
        foreach (LibrarySection::published()->get() as $section) {
            $entries[] = [
                'route' => 'library.section',
                'params' => [$section],
                'lastmod' => $section->updated_at?->toAtomString(),
                'priority' => '0.8',
            ];
        }

        foreach (LibraryArticle::published()->with('section')->get() as $article) {
            if (! $article->section?->is_published) {
                continue;
            }

            $entries[] = [
                'route' => 'library.article',
                'params' => [$article->section, $article],
                'lastmod' => $article->updated_at?->toAtomString(),
                'priority' => '0.6',
            ];
        }

        // Blog posts
        foreach (Post::published()->get() as $post) {
            $entries[] = [
                'route' => 'blog.show',
                'params' => [$post],
                'lastmod' => ($post->updated_at ?? $post->published_at)?->toAtomString(),
                'priority' => '0.6',
            ];
        }

        // Expand each page into one <url> per locale, each carrying the full set
        // of xhtml:link alternates so Google can group the translations.
        // English only while the language switcher is off — see config/site.php.
        $locales = \App\Support\Locale::switcherEnabled()
            ? array_keys(config('site.locales', ['en' => 'English']))
            : ['en'];

        $urls = [];

        foreach ($entries as $entry) {
            $params = $entry['params'] ?? [];

            $alternates = [];
            foreach ($locales as $locale) {
                $url = URL::routeForLocale($locale, $entry['route'], $params);

                if ($url !== null) {
                    $alternates[$locale] = $url;
                }
            }

            foreach ($alternates as $loc) {
                $urls[] = [
                    'loc' => $loc,
                    'lastmod' => $entry['lastmod'] ?? null,
                    'priority' => $entry['priority'],
                    'alternates' => $alternates,
                ];
            }
        }

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }
}
