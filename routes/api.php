<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('register', AuthController::class . '@register');
Route::post('login', AuthController::class . '@login');

Route::middleware(['auth:api'])->group(function () {
    Route::get('user', AuthController::class . '@getProfile');

    Route::middleware('role:admin|moderator')->group(function () {
        Route::get('users', UserController::class . '@index');
        Route::delete('users/{user}', UserController::class . '@destroy');
    });

    Route::middleware('role:admin|moderator|user')->group(function () {
        Route::get('users/{user', UserController::class . '@show');
        Route::put('users/{user}', UserController::class . '@update');
    });
});
