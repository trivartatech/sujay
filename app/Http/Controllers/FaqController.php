<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        return view('pages.faqs', [
            'faqs' => Faq::published()->orderBy('sort_order')->get(),
        ]);
    }
}
