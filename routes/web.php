<?php

use App\Http\Controllers\Apps\AboutPageController;
use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\PerfumePageController;
use App\Http\Controllers\Apps\ReviewController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\ShopPageController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['admin_or_redirect'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::name('user-management.')->group(function () {
        Route::resource('/user-management/users', UserManagementController::class);
        Route::resource('/user-management/roles', RoleManagementController::class);
        Route::resource('/user-management/permissions', PermissionManagementController::class);
    });

    Route::controller(LandingPageController::class)->prefix('admin/landing-page')->as('admin-landing-page.')->group(function () {
        Route::get('/', 'index')->name('list');
    });

    Route::controller(ShopPageController::class)->prefix('admin/shop-page')->as('admin.shop-page.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('/', 'update')->name('update');
        Route::post('products', 'storeProduct')->name('store-product');
        Route::put('products/{product}', 'updateProduct')->name('update-product');
        Route::delete('products/{product}', 'deleteProduct')->name('delete-product');
    });

    Route::controller(AboutPageController::class)->prefix('admin/about-page')->as('admin.about-page.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('/', 'update')->name('update');
    });

    Route::controller(PerfumePageController::class)->prefix('admin/perfume-page')->as('admin.perfume-page.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('/', 'update')->name('update');
        Route::post('perfumes', 'storePerfume')->name('store-perfume');
        Route::put('perfumes/{perfume}', 'updatePerfume')->name('update-perfume');
        Route::delete('perfumes/{perfume}', 'deletePerfume')->name('delete-perfume');
    });

    Route::controller(ReviewController::class)->prefix('admin/reviews')->as('admin.reviews.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::put('{review}', 'update')->name('update');
        Route::delete('{review}', 'delete')->name('delete');
    });
});

Route::get('/error', function () {
    abort(500);
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__ . '/auth.php';

require __DIR__ . '/frontend-routes.php';
