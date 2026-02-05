<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Propiedad;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PropiedadController extends Controller
{
    /**
     * Obtener listado de propiedades con filtros opcionales.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Propiedad::with(['agente.usuario', 'caracteristicasSostenibles']);

        // Filtrar solo disponibles (excluir vendidas)
        $query->where(function($q) {
            $q->where('estado', 'disponible')
              ->orWhere('estado', 'reservado');
        });

        // Filtrar por Ubicación (Ciudad)
        if ($request->has('ubicacion') && $request->ubicacion) {
            $query->where('ciudad', 'like', '%' . $request->ubicacion . '%');
        }

        // Filtrar por Tipo de Propiedad
        if ($request->has('tipo') && $request->tipo) {
            $query->where('tipo_propiedad', $request->tipo);
        }

        // Filtrar por Tipo de Operación (Venta/Alquiler)
        if ($request->has('operacion') && $request->operacion) {
            $query->where('tipo_operacion', $request->operacion);
        }

        // Filtrar por Certificación Energética
        if ($request->has('certificacion') && $request->certificacion) {
            $query->where('certificacion_energetica', $request->certificacion);
        }

        // Filtrar por Tipo de Energía
        if ($request->has('tipo_energia') && $request->tipo_energia) {
            $query->where('tipo_energia', 'like', '%' . $request->tipo_energia . '%');
        }

        $propiedades = $query->latest('fecha_publicacion')->get();

        return response()->json($propiedades);
    }

    /**
     * Obtener propiedades destacadas (últimas 3).
     */
    public function featured(): JsonResponse
    {
        $propiedades = Propiedad::with(['agente.usuario', 'caracteristicasSostenibles'])
            ->where(function($q) {
                $q->where('estado', 'disponible')
                  ->orWhere('estado', 'reservado');
            })
            ->latest('fecha_publicacion')
            ->take(3)
            ->get();

        return response()->json($propiedades);
    }

    /**
     * Mostrar una propiedad específica.
     */
    public function show($id): JsonResponse
    {
        $propiedad = Propiedad::with(['agente.usuario', 'contratos', 'caracteristicasSostenibles'])
            ->findOrFail($id);

        return response()->json($propiedad);
    }
}
