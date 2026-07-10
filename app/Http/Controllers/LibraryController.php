<?php

namespace App\Http\Controllers;

use App\Models\LibraryArticle;
use App\Models\LibrarySection;
use Illuminate\View\View;

class LibraryController extends Controller
{
    public function index(): View
    {
        return view('library.index', [
            'sections' => LibrarySection::published()
                ->withCount(['articles' => fn ($q) => $q->where('is_published', true)])
                ->orderBy('sort_order')
                ->get(),
        ]);
    }

    public function section(LibrarySection $section): View
    {
        abort_unless($section->is_published, 404);

        return view('library.section', [
            'section' => $section,
            'articles' => $section->publishedArticles()->get(),
            'otherSections' => LibrarySection::published()
                ->whereKeyNot($section->getKey())
                ->orderBy('sort_order')
                ->get(),
        ]);
    }

    public function article(LibrarySection $section, LibraryArticle $article): View
    {
        abort_unless($section->is_published && $article->is_published, 404);
        abort_unless($article->library_section_id === $section->getKey(), 404);

        return view('library.article', [
            'section' => $section,
            'article' => $article,
            'related' => $section->publishedArticles()
                ->whereKeyNot($article->getKey())
                ->take(4)
                ->get(),
        ]);
    }
}
