<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Usuario;
use App\Models\Propiedad;
// use App\Models\Venta; // Future implementation

class DashboardController extends Controller
{
    public function stats(): JsonResponse // Modified method signature
    {
        // Simple counts for now
        $stats = [
            'usuarios' => Usuario::count(),
            'propiedades' => Propiedad::where('estado', 'disponible')->count(),
            'ventas' => Propiedad::where('estado', 'vendido')->count(), // Removed comment
        ];

        return response()->json($stats);
    }
}
