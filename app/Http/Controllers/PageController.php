<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        return view('pages.about', [
            'stats' => [
                'years' => Setting::get('stats.years_experience', 0),
                'surgeries' => Setting::get('stats.surgeries_performed', 0),
            ],
        ]);
    }
}
