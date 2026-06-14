<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $posts = Post::published()
            ->with('category')
            ->when($request->string('category')->isNotEmpty(), function ($query) use ($request) {
                $query->whereHas('category', fn ($q) => $q->where('slug', $request->string('category')));
            })
            ->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        return view('blog.index', [
            'posts' => $posts,
            'categories' => Category::orderBy('name')->get(),
            'activeCategory' => $request->string('category')->toString(),
        ]);
    }

    public function show(Post $post): View
    {
        abort_unless(
            $post->status === \App\Enums\PostStatus::Published
                && $post->published_at !== null
                && $post->published_at->isPast(),
            404
        );

        return view('blog.show', [
            'post' => $post->load('category', 'tags'),
            'related' => Post::published()
                ->where('category_id', $post->category_id)
                ->whereKeyNot($post->getKey())
                ->latest('published_at')
                ->take(3)
                ->get(),
        ]);
    }
}
