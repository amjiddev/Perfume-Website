<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PerfumeController;
use App\Http\Controllers\Frontend\PerfumePageController;
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
Route::get('/attar', [PerfumeController::class, 'attar'])->name('attar');
Route::get('/product/{id}', [PerfumeController::class, 'productDetail'])->name('product.detail');
Route::get('/about', [PerfumeController::class, 'about'])->name('about');
Route::get('/contact', [PerfumeController::class, 'contact'])->name('contact');
