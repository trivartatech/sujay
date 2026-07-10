<?php

namespace App\Http\Controllers;

use App\Models\LibraryArticle;
use App\Models\LibrarySection;
use App\Models\Post;
use App\Models\Procedure;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [];

        // Static pages
        $static = ['home', 'about', 'philosophy', 'services.index', 'library.index', 'faqs', 'blog.index', 'contact', 'appointment.create'];
        foreach ($static as $name) {
            $urls[] = ['loc' => route($name), 'priority' => $name === 'home' ? '1.0' : '0.7'];
        }

        // Services
        foreach (Procedure::published()->get() as $procedure) {
            $urls[] = [
                'loc' => route('services.show', $procedure),
                'lastmod' => $procedure->updated_at?->toAtomString(),
                'priority' => '0.8',
            ];
        }

        // Heart Health Library sections + their articles
        foreach (LibrarySection::published()->get() as $section) {
            $urls[] = [
                'loc' => route('library.section', $section),
                'lastmod' => $section->updated_at?->toAtomString(),
                'priority' => '0.8',
            ];
        }

        foreach (LibraryArticle::published()->with('section')->get() as $article) {
            if (! $article->section?->is_published) {
                continue;
            }

            $urls[] = [
                'loc' => route('library.article', [$article->section, $article]),
                'lastmod' => $article->updated_at?->toAtomString(),
                'priority' => '0.6',
            ];
        }

        // Blog posts
        foreach (Post::published()->get() as $post) {
            $urls[] = [
                'loc' => route('blog.show', $post),
                'lastmod' => ($post->updated_at ?? $post->published_at)?->toAtomString(),
                'priority' => '0.6',
            ];
        }

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }
}
