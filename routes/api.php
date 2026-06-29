<?php

use App\Actions\SamplePermissionApi;
use App\Actions\SampleRoleApi;
use App\Actions\SampleUserApi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {

    Route::get('/users', function (Request $request) {
        return app(SampleUserApi::class)->datatableList($request);
    });

    Route::post('/users-list', function (Request $request) {
        return app(SampleUserApi::class)->datatableList($request);
    });

    Route::post('/users', function (Request $request) {
        return app(SampleUserApi::class)->create($request);
    });

    Route::get('/users/{id}', function ($id) {
        return app(SampleUserApi::class)->get($id);
    });

    Route::put('/users/{id}', function ($id, Request $request) {
        return app(SampleUserApi::class)->update($id, $request);
    });

    Route::delete('/users/{id}', function ($id) {
        return app(SampleUserApi::class)->delete($id);
    });


    Route::get('/roles', function (Request $request) {
        return app(SampleRoleApi::class)->datatableList($request);
    });

    Route::post('/roles-list', function (Request $request) {
        return app(SampleRoleApi::class)->datatableList($request);
    });

    Route::post('/roles', function (Request $request) {
        return app(SampleRoleApi::class)->create($request);
    });

    Route::get('/roles/{id}', function ($id) {
        return app(SampleRoleApi::class)->get($id);
    });

    Route::put('/roles/{id}', function ($id, Request $request) {
        return app(SampleRoleApi::class)->update($id, $request);
    });

    Route::delete('/roles/{id}', function ($id) {
        return app(SampleRoleApi::class)->delete($id);
    });

    Route::post('/roles/{id}/users', function (Request $request, $id) {
        $request->merge(['id' => $id]);
        return app(SampleRoleApi::class)->usersDatatableList($request);
    });

    Route::delete('/roles/{id}/users/{user_id}', function ($id, $user_id) {
        return app(SampleRoleApi::class)->deleteUser($id, $user_id);
    });



    Route::get('/permissions', function (Request $request) {
        return app(SamplePermissionApi::class)->datatableList($request);
    });

    Route::post('/permissions-list', function (Request $request) {
        return app(SamplePermissionApi::class)->datatableList($request);
    });

    Route::post('/permissions', function (Request $request) {
        return app(SamplePermissionApi::class)->create($request);
    });

    Route::get('/permissions/{id}', function ($id) {
        return app(SamplePermissionApi::class)->get($id);
    });

    Route::put('/permissions/{id}', function ($id, Request $request) {
        return app(SamplePermissionApi::class)->update($id, $request);
    });

    Route::delete('/permissions/{id}', function ($id) {
        return app(SamplePermissionApi::class)->delete($id);
    });
});

// Subscription Route (public)
Route::post('/subscribe', [\App\Http\Controllers\Api\SubscriptionController::class, 'subscribe'])->name('api.subscribe');

// Order Store Route (public)
Route::post('/orders', [\App\Http\Controllers\Api\OrderStoreController::class, 'store'])->name('api.orders.store');

// Order Routes
Route::post('/orders/{orderId}/approve', [\App\Http\Controllers\Api\OrderController::class, 'approve'])->name('api.orders.approve');
Route::post('/orders/{orderId}/reject', [\App\Http\Controllers\Api\OrderController::class, 'reject'])->name('api.orders.reject');
Route::post('/orders/{orderId}/pending', [\App\Http\Controllers\Api\OrderController::class, 'pending'])->name('api.orders.pending');
Route::post('/orders/{orderId}/mark-viewed', [\App\Http\Controllers\Api\OrderController::class, 'markAsViewed'])->name('api.orders.mark-viewed');
Route::delete('/orders/{orderId}', [\App\Http\Controllers\Api\OrderController::class, 'destroy'])->name('api.orders.destroy');
Route::get('/orders-by-status', [\App\Http\Controllers\Api\OrderController::class, 'getByStatus'])->name('api.orders.by-status');
Route::get('/status-counts', [\App\Http\Controllers\Api\OrderController::class, 'getStatusCounts'])->name('api.status-counts');

// SafePay Payment Routes
Route::post('/payments/initiate', [\App\Http\Controllers\Api\PaymentController::class, 'initiatePayment'])->name('api.payments.initiate');
Route::post('/payments/webhook', [\App\Http\Controllers\Api\PaymentController::class, 'webhook'])->name('api.payments.webhook')->withoutMiddleware('api');
Route::get('/payments/health', [\App\Http\Controllers\Api\PaymentController::class, 'healthCheck'])->name('api.payments.health');

