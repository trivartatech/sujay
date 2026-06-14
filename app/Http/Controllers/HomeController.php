<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Procedure;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('pages.home', [
            'procedures' => Procedure::published()->orderBy('sort_order')->take(6)->get(),
            'posts' => Post::published()->with('category')->latest('published_at')->take(3)->get(),
            'testimonials' => Testimonial::approved()->orderBy('sort_order')->take(6)->get(),
            'stats' => [
                'years' => Setting::get('stats.years_experience', 0),
                'surgeries' => Setting::get('stats.surgeries_performed', 0),
            ],
        ]);
    }
}
