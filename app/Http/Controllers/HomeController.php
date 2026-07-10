<?php

namespace App\Http\Controllers;

use App\Models\LibrarySection;
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
            // "Comprehensive Cardiac Care" icon strip
            'services' => Procedure::published()->orderBy('sort_order')->get(),
            // "Heart Health Library" card grid
            'sections' => LibrarySection::published()->orderBy('sort_order')->get(),
            // "Featured Blog & Research"
            'posts' => Post::published()->with('category')->latest('published_at')->take(6)->get(),
            'testimonials' => Testimonial::approved()->orderBy('sort_order')->take(6)->get(),
            'stats' => [
                'years' => Setting::get('stats.years_experience', 0),
                'patients' => Setting::get('stats.patients_treated', 0),
            ],
        ]);
    }
}
