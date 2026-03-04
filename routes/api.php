<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController; // <- Tambahkan ini!

// Debug route
Route::get('/debug-api', function () {
    return response()->json([
        'message' => 'API ROUTES WORKING ✅'
    ]);
});

// Auth Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});
