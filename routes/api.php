<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ToDoController;
use Illuminate\Support\Facades\Route;

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', action: [AuthController::class, 'login']);

Route::prefix(config('app.api_version'))->group(function () {
    // To Do routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('todos', ToDoController::class);
    });
});