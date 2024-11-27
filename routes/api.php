<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/trigger_auth', function (Request $request) {
    return response()->json([
        'status' => 'success',
        'message' => 'User retrieved successfully',
        'data' => $request->user(),
    ], 200);
});


Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');
//Route::post('/logout', LogoutController::class)->middleware('auth:sanctum');
Route::post('/logout', LogoutController::class)->middleware('auth');
