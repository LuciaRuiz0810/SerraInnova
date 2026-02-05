<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agente;
use Illuminate\Http\JsonResponse;

class AgenteController extends Controller
{
    /**
     * Obtener listado de agentes.
     */
    public function index(): JsonResponse
    {
        $agentes = Agente::with('usuario')->get();
        
        return response()->json($agentes);
    }
}
