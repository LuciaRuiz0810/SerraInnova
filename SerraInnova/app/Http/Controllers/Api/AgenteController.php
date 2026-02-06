<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agente;
use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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

    /**
     * Crear nuevo agente (y su usuario asociado).
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            // User data
            'nombre' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:6',
            
            // Agent data
            'telefono' => 'required|string|max:20',
            'dni' => 'required|string|max:20|unique:agentes,dni',
            'licencia' => 'nullable|string',
            'zona_trabajo' => 'nullable|string',
            'comision_porcentaje' => 'nullable|numeric|min:0|max:100',
        ]);

        return DB::transaction(function () use ($request) {
            // 1. Create Usuario
            $usuario = Usuario::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'tipo_usuario' => 'agente',
                'activo' => true,
            ]);

            // 2. Create Agente
            $agente = Agente::create([
                'id_usuario' => $usuario->id_usuario,
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'telefono' => $request->telefono,
                'dni' => $request->dni,
                'licencia' => $request->licencia,
                'zona_trabajo' => $request->zona_trabajo,
                'comision_porcentaje' => $request->comision_porcentaje,
                'ventas_totales' => 0,
            ]);

            return response()->json(['message' => 'Agente creado exitosamente', 'agente' => $agente], 201);
        });
    }

    /**
     * Mostrar agente específico.
     */
    public function show($id): JsonResponse
    {
        $agente = Agente::with('usuario')->findOrFail($id);
        return response()->json($agente);
    }

    /**
     * Actualizar agente y cuenta de usuario.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $agente = Agente::findOrFail($id);
        $usuario = $agente->usuario;

        $request->validate([
             'nombre' => 'sometimes|string|max:100',
             'apellidos' => 'sometimes|string|max:100',
             'email' => 'sometimes|email|unique:usuarios,email,' . $usuario->id_usuario . ',id_usuario',
             'password' => 'nullable|string|min:6', // Optional update
             'telefono' => 'sometimes|string|max:20',
             'dni' => 'sometimes|string|max:20|unique:agentes,dni,' . $agente->id_agente . ',id_agente',
             'comision_porcentaje' => 'nullable|numeric|min:0|max:100',
        ]);
        
        DB::transaction(function () use ($request, $agente, $usuario) {
            // Update Usuario if needed
            if ($request->has('email')) $usuario->email = $request->email;
            if ($request->filled('password')) $usuario->password = Hash::make($request->password);
            if ($usuario->isDirty()) $usuario->save();

            // Update Agente
            $agente->fill($request->only([
                'nombre', 'apellidos', 'telefono', 'dni', 'licencia', 'zona_trabajo', 'comision_porcentaje'
            ]));
            if ($agente->isDirty()) $agente->save();
        });

        return response()->json(['message' => 'Agente actualizado', 'agente' => $agente->fresh('usuario')]);
    }

    /**
     * Eliminar agente y su usuario.
     */
    public function destroy($id): JsonResponse
    {
        $agente = Agente::findOrFail($id);
        $usuario = $agente->usuario;

        DB::transaction(function () use ($agente, $usuario) {
            $agente->delete(); // Delete profile first due to constraints probably, or cascade
            if ($usuario) $usuario->delete(); // Delete login account
        });

        return response()->json(['message' => 'Agente eliminado correctamente']);
    }
}
