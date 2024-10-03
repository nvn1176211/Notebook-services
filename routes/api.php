<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TokenController;

// Route::apiResource('users', UserController::class);

Route::post('/tokens/create', [TokenController::class, 'create']);

Route::post('/user', [UserController::class, 'store']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
