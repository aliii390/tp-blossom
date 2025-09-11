<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlantesController;
use App\Http\Controllers\UserPlantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register',[AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login']);
Route::get('/plant', [PlantesController::class, 'index']);
Route::post('/plant', [PlantesController::class, 'store']);
Route::get('/plant/{name}', [PlantesController::class, 'show']);
Route::delete('/plant/{id}', [PlantesController::class, 'destroy']);


// route user connect
Route::get('/user/plant', [UserPlantController::class, 'index'])->middleware('auth:sanctum');
Route::post('/user/plant', [UserPlantController::class, 'store'])->middleware('auth:sanctum');
Route::delete('/user/plant/{id}', [UserPlantController::class, 'destroy'])->middleware('auth:sanctum');