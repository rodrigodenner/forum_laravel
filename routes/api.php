<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SupportController;
use App\Http\Controllers\Api\Auth\AuthController;


 Route::post('/login',[AuthController::class,'auth']);
 Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
 Route::get('/me',[AuthController::class,'me'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function(){
  Route::apiResource('/supports',SupportController::class);
});
