<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController as ApiPostController;

Route::get('/health', fn () => response()->json(['ok' => true]));

Route::post('/login',  [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me',      [AuthController::class, 'me'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/posts',           [ApiPostController::class, 'index']);
    Route::get('/posts/{id}',      [ApiPostController::class, 'show']);
    Route::post('/posts',          [ApiPostController::class, 'store']);
    Route::put('/posts/{id}',      [ApiPostController::class, 'update']);
    Route::delete('/posts/{id}',   [ApiPostController::class, 'destroy']);
});
