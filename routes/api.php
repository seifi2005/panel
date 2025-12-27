<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReceptorAuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ReceptorController;
use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
 
 

// ========== Receptor Authentication (JWT) ==========
Route::post('/get_token', [ReceptorAuthController::class, 'getToken']);

Route::middleware('jwt.auth')->group(function () {
    Route::get('/receptor/me', [ReceptorAuthController::class, 'me']);
    Route::post('/receptor/refresh', [ReceptorAuthController::class, 'refresh']);
    // سایر route های receptor اینجا
});

// ========== User Authentication (Sanctum) ==========
Route::post('/auth/send-otp', [AuthController::class, 'sendOtp']);
Route::post('/auth/login/otp', [AuthController::class, 'loginWithOtp']);
Route::post('/auth/login/password', [AuthController::class, 'loginWithPassword']);

Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);

    // User Management (super_admin & operator only)
    Route::apiResource('users', UserController::class);

    // Receptor Management (super_admin & operator only)
    Route::apiResource('receptors', ReceptorController::class);

    // Order Management (super_admin & operator only)
    Route::get('/orders/receptors', [OrderController::class, 'getReceptorsForOrders']);
    Route::post('/orders/check/{receptorId}', [OrderController::class, 'checkOrders']);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::post('/orders/search', [OrderController::class, 'search']);
});
