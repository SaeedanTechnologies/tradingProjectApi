<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Api\Auth\AuthController;


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::middleware('auth:sanctum')->group( function () {
        Route::get('logout', 'logout');
    });
});





