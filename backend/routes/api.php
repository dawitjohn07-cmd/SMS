<?php
use Illuminate\Support\Facades\Route; use App\Http\Controllers\Api\AuthController; use App\Http\Controllers\Api\StudentController; use App\Http\Controllers\Api\DashboardController; use App\Http\Controllers\Api\ActivityController;
Route::post('/login',[AuthController::class,'login'])->middleware('throttle:10,1');
Route::middleware('auth:sanctum')->group(function(){Route::post('/logout',[AuthController::class,'logout']);Route::get('/me',[AuthController::class,'me']);Route::put('/profile',[AuthController::class,'updateProfile']);Route::put('/password',[AuthController::class,'password']);Route::get('/dashboard',DashboardController::class);Route::apiResource('students',StudentController::class);Route::get('/activities',[ActivityController::class,'index']);});
