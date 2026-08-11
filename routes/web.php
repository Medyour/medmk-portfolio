<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:contact')
    ->name('contact.store');
Route::view('/confidentialite', 'legal.privacy')->name('privacy');
Route::view('/mentions-legales', 'legal.legal-notice')->name('legal');
