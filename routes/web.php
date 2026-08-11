<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/confidentialite', 'legal.privacy')->name('privacy');
Route::view('/mentions-legales', 'legal.legal-notice')->name('legal');
