<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:contact')
    ->name('contact.store');
Route::view('/confidentialite', 'legal.privacy')->name('privacy');
Route::view('/mentions-legales', 'legal.legal-notice')->name('legal');

Route::get('/robots.txt', function () {
    $content = app()->environment('production')
        ? "User-agent: *\nAllow: /\nSitemap: ".route('sitemap')."\n"
        : "User-agent: *\nDisallow: /\n";

    return response($content)->header('Content-Type', 'text/plain; charset=UTF-8');
})->name('robots');

Route::get('/sitemap.xml', function () {
    return response()
        ->view('seo.sitemap', [
            'urls' => [route('home'), route('privacy'), route('legal')],
        ])
        ->header('Content-Type', 'application/xml; charset=UTF-8');
})->name('sitemap');
