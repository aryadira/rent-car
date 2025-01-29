<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\TenantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('a1')->group(function () {

    // auth routes
    Route::prefix('auth')->name('auth.')->group(function () {
        Route::post('register', [AuthController::class, 'register'])->name('register');
        Route::post('login', [AuthController::class, 'login'])->name('login');
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('auth')->name('auth.')->group(function () {
            Route::delete('logout', [AuthController::class, 'logout'])->name('logout');
        });

        Route::resource('tenants', TenantController::class);
        Route::resource('rents', RentController::class);

        Route::get('test', function () {
            return "Test authorize";
        });
    });

});
