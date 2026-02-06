<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PropiedadController;
use App\Http\Controllers\Api\AgenteController;
use App\Http\Controllers\Api\AdminUserController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas de autenticación
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas con autenticación
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::redirect('/logout', '/welcome');

    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/profile', [AuthController::class, 'updateProfile']);
    
    // Estadísticas
    Route::get('/admin/stats', [DashboardController::class, 'stats']);
    
    // CRUD Agentes
    Route::apiResource('/admin/agentes', AgenteController::class);

    // CRUD Usuarios
    Route::apiResource('/admin/usuarios', AdminUserController::class);
    
    // Admin Propiedades (Lista completa)
    Route::get('/admin/propiedades', [PropiedadController::class, 'indexAdmin']);
});

// Rutas públicas de propiedades
Route::prefix('propiedades')->group(function () {
    Route::get('/', [PropiedadController::class, 'index']);
    Route::get('/featured', [PropiedadController::class, 'featured']);
    Route::get('/{id}', [PropiedadController::class, 'show']);
});

// Rutas protegidas de propiedades (agentes y admins)
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/propiedades', [PropiedadController::class, 'store']);
    Route::put('/propiedades/{id}', [PropiedadController::class, 'update']);
    Route::delete('/propiedades/{id}', [PropiedadController::class, 'destroy']);
    Route::post('/propiedades/{id}/imagenes', [PropiedadController::class, 'uploadImage']); // Opcional si se separa
});

// Rutas públicas de agentes
Route::get('/agentes', [AgenteController::class, 'index']);
