<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlantesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register',[AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'login']);


Route::get('/plant', [PlantesController::class, 'index']);

Route::post('/plant', [PlantesController::class, 'store']);