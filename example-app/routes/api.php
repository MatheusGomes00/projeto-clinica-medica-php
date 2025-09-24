<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;


// Route::get('/auth/redirect', [AuthController::class,'redirectToAuthorization']);
// Route::get('/auth/callback', [AuthController::class,'callback']);
// Route::get('/auth/refresh', [AuthController::class,'refreshToken']);

Route::middleware('auth:api')->group(function() {
    Route::get('/user', [AuthController::class,'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
