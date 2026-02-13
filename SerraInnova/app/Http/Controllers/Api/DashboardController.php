<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Usuario;
use App\Models\Propiedad;


class DashboardController extends Controller
{
    public function stats(): JsonResponse 
    {
        $stats = [
            'usuarios' => Usuario::count(),
            'propiedades' => Propiedad::where('estado', 'disponible')->count(),
            'ventas' => Propiedad::where('estado', 'vendido')->count(), 
        ];

        return response()->json($stats);
    }
}
