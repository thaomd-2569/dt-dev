<?php

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

Route::prefix('v1')->group(function () {
    Route::post('login', [\Modules\Admin\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'login']);

    Route::middleware(['auth:sanctum', 'abilities:admin'])->group(function () {
        Route::apiResource('categories', \Modules\Admin\App\Http\Controllers\Api\V1\CategoryController::class)->whereNumber('category');
        Route::post('logout', [\Modules\Admin\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'logout']);
        Route::get('profile', [\Modules\Admin\App\Http\Controllers\Api\V1\Auth\AuthController::class, 'profile']);

        Route::patch('categories/{category}/status', [\Modules\Admin\App\Http\Controllers\Api\V1\CategoryController::class, 'updateStatus'])
            ->whereNumber('category');
    });
});
