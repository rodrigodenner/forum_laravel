<?php

use App\Http\Controllers\Api\SupportController;
use Illuminate\Support\Facades\Route;

//Criando a Rota da api 
Route::apiResource('/supports',SupportController::class);
