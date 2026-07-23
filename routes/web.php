<?php

use App\Http\Controllers\Apps\AboutPageController;
use App\Http\Controllers\Apps\ContactPageController;
use App\Http\Controllers\Apps\EmailSubscriptionController;
use App\Http\Controllers\Apps\FooterSettingsController;
use App\Http\Controllers\Apps\GuestGiftController;
use App\Http\Controllers\Apps\HomePageController;
use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\PerfumePageController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\ShopPageController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['admin_or_redirect'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile update routes
    Route::post('/admin/profile/update', function (Request $request) {
        $user = $request->user();

        if (! $user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        if ($request->hasFile('profile_photo_path')) {
            $path = $request->file('profile_photo_path')->store('profile', 'public');
            $user->profile_photo_path = 'storage/' . $path;
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return response()->json(['success' => true, 'message' => 'Profile updated successfully']);
    });
    
    Route::post('/admin/password/update', function (Request $request) {
        $user = $request->user();

        if (! $user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        if (! Hash::check($request->input('current_password'), $user->password)) {
            return response()->json(['success' => false, 'message' => 'Current password is incorrect']);
        }

        if ($request->input('password') !== $request->input('password_confirmation')) {
            return response()->json(['success' => false, 'message' => 'Passwords do not match']);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response()->json(['success' => true, 'message' => 'Password updated successfully']);
    });

    Route::name('user-management.')->group(function () {
        Route::resource('/user-management/users', UserManagementController::class);
        Route::resource('/user-management/roles', RoleManagementController::class);
        Route::resource('/user-management/permissions', PermissionManagementController::class);
    });

    Route::controller(LandingPageController::class)->prefix('admin/landing-page')->as('admin-landing-page.')->group(function () {
        Route::get('/', 'index')->name('list');
        Route::put('/', 'update')->name('update');
        Route::post('delete-image', 'deleteImage')->name('delete-image');
    });

    Route::controller(ShopPageController::class)->prefix('admin/shop-page')->as('admin.shop-page.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('/', 'update')->name('update');
        Route::post('delete-image', 'deleteImage')->name('delete-image');
        Route::post('delete-product-image/{product}', 'deleteProductImage')->name('delete-product-image');
        Route::post('products', 'storeProduct')->name('store-product');
        Route::put('products/{product}', 'updateProduct')->name('update-product');
        Route::delete('products/{product}', 'deleteProduct')->name('delete-product');
    });

    Route::controller(AboutPageController::class)->prefix('admin/about-page')->as('admin.about-page.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('/', 'update')->name('update');
        Route::post('delete-image', 'deleteImage')->name('delete-image');
    });

    Route::controller(ContactPageController::class)->prefix('admin/contact-page')->as('admin.contact-page.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('/', 'update')->name('update');
        Route::post('delete-image', 'deleteImage')->name('delete-image');
    });

    Route::controller(GuestGiftController::class)->prefix('admin/guest-gift')->as('admin.guest-gift.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::put('{guestGift}', 'update')->name('update');
        Route::delete('{guestGift}', 'delete')->name('delete');
    });

    Route::controller(PerfumePageController::class)->prefix('admin/perfume-page')->as('admin.perfume-page.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('/', 'update')->name('update');
        Route::post('delete-image', 'deleteImage')->name('delete-image');
        Route::post('delete-perfume-image/{perfume}', 'deletePerfumeImage')->name('delete-perfume-image');
        Route::post('perfumes', 'storePerfume')->name('store-perfume');
        Route::put('perfumes/{perfume}', 'updatePerfume')->name('update-perfume');
        Route::delete('perfumes/{perfume}', 'deletePerfume')->name('delete-perfume');
    });

    Route::controller(\App\Http\Controllers\Apps\AttarPageController::class)->prefix('admin/attar-page')->as('admin.attar-page.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('/', 'update')->name('update');
        Route::post('delete-image', 'deleteImage')->name('delete-image');
        Route::post('delete-product-image/{attarProduct}', 'deleteProductImage')->name('delete-product-image');
        Route::post('products', 'storeProduct')->name('store-product');
        Route::put('products/{attarProduct}', 'updateProduct')->name('update-product');
        Route::delete('products/{attarProduct}', 'deleteProduct')->name('delete-product');
    });

    Route::controller(HomePageController::class)->prefix('admin/home-page')->as('admin.home-page.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('/', 'update')->name('update');
    });

    Route::controller(FooterSettingsController::class)->prefix('admin/footer-settings')->as('admin.footer-settings.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('edit', 'edit')->name('edit');
        Route::put('/', 'update')->name('update');
    });

    Route::controller(\App\Http\Controllers\Apps\ContactMessageController::class)->prefix('admin/messages')->as('admin.messages.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('{message}', 'show')->name('show');
        Route::post('{message}/mark-read', 'markAsRead')->name('mark-read');
        Route::delete('{message}', 'destroy')->name('destroy');
    });

    Route::controller(\App\Http\Controllers\Apps\EmailSubscriptionController::class)->prefix('admin/email-subscriptions')->as('admin.email-subscriptions.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::delete('{subscription}', 'destroy')->name('destroy');
    });
});

Route::get('/error', function () {
    abort(500);
});

Route::get('/checkout/success', function () {
    return view('frontend.checkout-success');
})->name('checkout.success');
Route::get('/checkout/failure', function () {
    return view('frontend.checkout-failure');
})->name('checkout.failure');

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

// Payment Routes

require __DIR__ . '/auth.php';

require __DIR__ . '/frontend-routes.php';
