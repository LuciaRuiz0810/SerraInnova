<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PropiedadController;
use App\Http\Controllers\Api\AgenteController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas públicas de propiedades
Route::prefix('propiedades')->group(function () {
    Route::get('/', [PropiedadController::class, 'index']);
    Route::get('/featured', [PropiedadController::class, 'featured']);
    Route::get('/{id}', [PropiedadController::class, 'show']);
});

// Rutas públicas de agentes
Route::get('/agentes', [AgenteController::class, 'index']);
