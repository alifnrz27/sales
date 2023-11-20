<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthController;

use App\Http\Controllers\API\AllRole\SalesController as AllRoleSalesController;
use App\Http\Controllers\API\AllRole\RegisterController;
use App\Http\Controllers\API\AllRole\ProfileController;
use App\Http\Controllers\API\Admin\SalesController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['api', 'secret'], 'prefix' => 'v1', 'as' => 'api.'], function () {
    Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::post('register', [RegisterController::class, 'store'])->name('register.sales');

    Route::group(['middleware' => ['jwtToken']], function () {
        Route::get('check-authenticate', [AuthController::class, 'checkAuthenticate'])->name('authenticate.check');
    });

    Route::group(['middleware' => ['jwtToken', 'verified']], function () {

        Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');

        Route::group(['middleware' => ['jwtToken', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
            // Sales management
            Route::group(['prefix' => 'sales', 'as' => 'sales.',], function () {
                Route::get('', [SalesController::class, 'index'])->name('get');
                Route::get('confirm', [SalesController::class, 'showConfirm'])->name('get.confirm');
                Route::get('confirm/{sales_uuid}', [SalesController::class, 'showSpesificConfirm'])->name('get.sales.confirm');
                Route::post('confirm/{sales_uuid}', [SalesController::class, 'salesConfirm'])->name('store.confirm');
                Route::get('{sales_uuid}', [SalesController::class, 'show'])->name('show');
                Route::post('', [SalesController::class, 'store'])->name('store');
                Route::post('{sales_uuid}', [SalesController::class, 'update'])->name('update');
                Route::delete('{sales_uuid}', [SalesController::class, 'delete'])->name('delete');
            });
            // end sales management
        });
    });

    Route::post('submit-phone-number/{sales_username}', [AllRoleSalesController::class, 'submitPhoneNumber'])->name('submit.phone-number');
    Route::post('{sales_username}', [AllRoleSalesController::class, 'show'])->name('get.sales');
});
