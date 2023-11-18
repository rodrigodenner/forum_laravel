<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SupportController;
use App\Http\Controllers\Api\Auth\AuthController;


 Route::post('/login',[AuthController::class,'auth']);

Route::middleware(['auth:sanctum'])->group(function(){
  Route::apiResource('/supports',SupportController::class);
});
