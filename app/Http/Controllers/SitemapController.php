<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Procedure;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [];

        // Static pages
        foreach (['home', 'about', 'procedures.index', 'blog.index', 'contact', 'appointment.create'] as $name) {
            $urls[] = ['loc' => route($name), 'priority' => $name === 'home' ? '1.0' : '0.7'];
        }

        // Procedures
        foreach (Procedure::published()->get() as $procedure) {
            $urls[] = [
                'loc' => route('procedures.show', $procedure),
                'lastmod' => $procedure->updated_at?->toAtomString(),
                'priority' => '0.8',
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
