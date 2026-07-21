<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProcedureController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/**
 * Every public page, registered once per locale.
 *
 * English keeps the bare URLs it has always had (/faqs, /blog/…) so the pages
 * Google has already indexed do not move. The other locales are registered
 * again behind their own prefix (/kn/faqs, /hi/blog/…) with route names
 * prefixed to match ("kn.faqs").
 *
 * Views still call route('faqs') with no locale argument — LocalizedUrlGenerator
 * redirects the lookup to the current locale's copy. See app/Support.
 */
$publicRoutes = function () {
    // Home
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Meet Dr. Sujay / Philosophy of Care
    Route::get('/meet-dr-sujay', [PageController::class, 'about'])->name('about');
    Route::get('/philosophy-of-care', [PageController::class, 'philosophy'])->name('philosophy');

    // Services ("Comprehensive Cardiac Care")
    Route::get('/services', [ProcedureController::class, 'index'])->name('services.index');
    Route::get('/services/{procedure:slug}', [ProcedureController::class, 'show'])->name('services.show');

    // Heart Health Library — sections and the articles inside them
    Route::get('/heart-health-library', [LibraryController::class, 'index'])->name('library.index');
    Route::get('/heart-health-library/{section:slug}', [LibraryController::class, 'section'])->name('library.section');
    Route::get('/heart-health-library/{section:slug}/{article:slug}', [LibraryController::class, 'article'])->name('library.article');

    // FAQs
    Route::get('/faqs', [FaqController::class, 'index'])->name('faqs');

    // Blog ("Featured Blog & Research")
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');

    // Contact + enquiry
    Route::get('/contact', [ContactController::class, 'show'])->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    // Appointments ("Request Consultation")
    Route::get('/appointment', [AppointmentController::class, 'create'])->name('appointment.create');
    Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.store');
};

// English at the root — unchanged URLs, unprefixed route names.
Route::group([], $publicRoutes);

// Every other locale behind its own prefix.
foreach (array_keys(config('site.locales', [])) as $locale) {
    if ($locale === 'en') {
        continue;
    }

    Route::prefix($locale)->name($locale.'.')->group($publicRoutes);
}

// SEO — one sitemap covering every locale, so it stays outside the loop.
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
