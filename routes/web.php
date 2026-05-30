<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/destinations', [FrontendController::class, 'destinations'])->name('destinations');
Route::get('/destinations/{slug}', [FrontendController::class, 'destination'])->name('destination.show');
Route::get('/trips', [FrontendController::class, 'trips'])->name('trips');
Route::get('/trips/{slug}', [FrontendController::class, 'trip'])->name('trip.show');
Route::get('/testimonials', [FrontendController::class, 'testimonials'])->name('testimonials');
Route::get('/gallery', [FrontendController::class, 'gallery'])->name('gallery');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/testimonials', [FrontendController::class, 'submitTestimonial'])->name('testimonials.submit');
