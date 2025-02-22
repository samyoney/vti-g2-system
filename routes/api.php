<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskDoneController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/trigger_auth', function (Request $request) {
        return response()->json([
            'status' => 'success',
            'message' => 'User retrieved successfully',
            'data' => $request->user(),
        ], 200);
    });

    Route::apiResource('/tasks', TaskController::class);
    Route::patch('/tasks/{task}/done', TaskDoneController::class);

    /**
     * Auth related
     */
    Route::get('/users/auth', AuthController::class);

    /**
     * Users
     */
    Route::put('/users/{user}/avatar', [UserController::class, 'updateAvatar']);
    Route::resource('users', UserController::class);

    /**
     * Roles
     */
    Route::get('/roles/search', [RoleController::class, 'search'])->middleware('throttle:400,1');

//    Route::get('/tasks/{task}/done', TaskDoneController::class);
});

//Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
//Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');
//Route::post('/logout', LogoutController::class)->middleware('auth');

