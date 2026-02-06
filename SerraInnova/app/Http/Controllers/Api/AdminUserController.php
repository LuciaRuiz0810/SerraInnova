<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Listar usuarios.
     */
    public function index(): JsonResponse
    {
        $usuarios = Usuario::all(); // Removed latest('fecha_registro') to avoid SQL errors if column missing
        return response()->json($usuarios);
    }

    /**
     * Crear usuario.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:6',
            'tipo_usuario' => 'required|in:comprador,vendedor,administrador', // 'agente' should use Agent CRUD ideally, but admin can do it here too basically
            'activo' => 'boolean'
        ]);

        $usuario = Usuario::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo_usuario' => $request->tipo_usuario,
            'activo' => $request->has('activo') ? $request->activo : true,
        ]);

        return response()->json(['message' => 'Usuario creado', 'usuario' => $usuario], 201);
    }

    /**
     * Ver usuario.
     */
    public function show($id): JsonResponse
    {
        $usuario = Usuario::findOrFail($id);
        return response()->json($usuario);
    }

    /**
     * Actualizar usuario.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'email' => 'sometimes|email|unique:usuarios,email,' . $id . ',id_usuario',
            'password' => 'nullable|string|min:6',
            'tipo_usuario' => 'sometimes|in:comprador,vendedor,administrador,agente',
            'activo' => 'boolean'
        ]);

        if ($request->has('email')) $usuario->email = $request->email;
        if ($request->filled('password')) $usuario->password = Hash::make($request->password);
        if ($request->has('tipo_usuario')) $usuario->tipo_usuario = $request->tipo_usuario;
        if ($request->has('activo')) $usuario->activo = $request->activo;

        $usuario->save();

        return response()->json(['message' => 'Usuario actualizado', 'usuario' => $usuario]);
    }

    /**
     * Eliminar usuario.
     */
    public function destroy($id): JsonResponse
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return response()->json(['message' => 'Usuario eliminado']);
    }
}
