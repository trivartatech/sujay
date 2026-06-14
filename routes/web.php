<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public site routes
|--------------------------------------------------------------------------
| Phase 2/3 will flesh these out with controllers + Blade views. Stubs are
| kept here so the route map is documented from the start. The Filament
| admin panel registers its own routes under /admin via AdminPanelProvider.
*/

Route::view('/', 'welcome')->name('home');

// Phase 2 — public pages (controllers added later)
// Route::get('/about', [PageController::class, 'about'])->name('about');
// Route::get('/procedures', [ProcedureController::class, 'index'])->name('procedures.index');
// Route::get('/procedures/{procedure:slug}', [ProcedureController::class, 'show'])->name('procedures.show');
// Route::get('/contact', [ContactController::class, 'show'])->name('contact');
// Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Phase 3 — blog
// Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
// Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');

// Phase 4 — appointments
// Route::get('/appointment', [AppointmentController::class, 'create'])->name('appointment.create');
// Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.store');
