<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WeddingController;
use App\Http\Controllers\commentController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/changePassword', [AuthController::class, 'changePassword']);
    
    Route::prefix('auth')->group(function () {
        Route::get('wedding/', [WeddingController::class, 'index']);
        Route::post('wedding/', [WeddingController::class, 'store']);
        Route::put('wedding/{id}', [WeddingController::class, 'update']);
        Route::delete('wedding/{id}', [WeddingController::class, 'destroy']);
    });
});

Route::post('/wedding/{id}/comment', [commentController::class, 'store']);
Route::get('/wedding/{id}/comment', [commentController::class, 'index']);
Route::get('/wedding/{wedding_id}/comment/{comment_id}', [commentController::class, 'show']);
Route::get('/wedding/{id}', [WeddingController::class, 'show']);

Route::get('/greeting', function () {
    return 'Hello World';
});
