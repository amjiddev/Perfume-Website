<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PerfumeController;
use App\Http\Controllers\Frontend\PerfumePageController;
use App\Http\Controllers\Frontend\AttarPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Routes (Public - No Authentication)
|--------------------------------------------------------------------------
*/

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Perfume Pages
Route::get('/shop', [PerfumeController::class, 'shop'])->name('shop');
Route::get('/perfumes', [PerfumePageController::class, 'index'])->name('perfumes');
Route::get('/attar', [AttarPageController::class, 'index'])->name('attar');
Route::get('/attar/{id}', [AttarPageController::class, 'show'])->name('attar.detail');
Route::get('/product/{id}', [PerfumeController::class, 'productDetail'])->name('product.detail');
Route::get('/checkout', [PerfumeController::class, 'checkout'])->name('checkout');
Route::get('/about', [PerfumeController::class, 'about'])->name('about');
Route::get('/contact', [PerfumeController::class, 'contact'])->name('contact');
Route::get('/privacy-policy', [PerfumeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms-and-conditions', [PerfumeController::class, 'termsAndConditions'])->name('terms-and-conditions');
Route::get('/disclaimer', [PerfumeController::class, 'disclaimer'])->name('disclaimer');
Route::post('/contact/submit', [\App\Http\Controllers\Apps\ContactMessageController::class, 'store'])->name('contact.submit');
