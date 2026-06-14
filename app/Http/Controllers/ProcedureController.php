<?php

namespace App\Http\Controllers;

use App\Models\Procedure;
use Illuminate\View\View;

class ProcedureController extends Controller
{
    public function index(): View
    {
        return view('procedures.index', [
            'procedures' => Procedure::published()->orderBy('sort_order')->get(),
        ]);
    }

    public function show(Procedure $procedure): View
    {
        abort_unless($procedure->is_published, 404);

        return view('procedures.show', [
            'procedure' => $procedure,
            'related' => Procedure::published()
                ->whereKeyNot($procedure->getKey())
                ->orderBy('sort_order')
                ->take(3)
                ->get(),
        ]);
    }
}
