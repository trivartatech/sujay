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
                'patients' => Setting::get('stats.patients_treated', 0),
            ],
        ]);
    }

    public function philosophy(): View
    {
        return view('pages.philosophy');
    }
}
