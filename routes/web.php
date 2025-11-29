<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// API-only application - web routes disabled
Route::get('/', function () {
    return response()->json([
        'message' => 'This is an API-only Laravel application',
        'api_endpoint' => '/api'
    ]);
});
