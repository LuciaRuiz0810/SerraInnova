<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Agente;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'tipo_usuario' => 'required|in:agente,cliente',
            'nombre' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:8|confirmed',
            'telefono' => 'required|string|max:20',
            

            'dni' => 'required_if:tipo_usuario,agente|nullable|string|max:20|unique:agentes,dni|unique:clientes,dni',
            

            'direccion' => 'nullable|string|max:200',
        ]);


        $usuario = Usuario::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo_usuario' => $request->tipo_usuario,
            'activo' => true,
        ]);


        if ($request->tipo_usuario === 'agente') {
            Agente::create([
                'id_usuario' => $usuario->id_usuario,
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'telefono' => $request->telefono,
                'dni' => $request->dni,
                'licencia' => 'LIC-' . str_pad($usuario->id_usuario, 6, '0', STR_PAD_LEFT),
                'zona_trabajo' => 'Sin asignar',
                'comision_porcentaje' => 3.00,
                'ventas_totales' => 0,
            ]);
        } else {
            Cliente::create([
                'id_usuario' => $usuario->id_usuario,
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
            ]);
        }


        $token = $usuario->createToken('auth_token')->plainTextToken;


        $usuario->load(['agente', 'cliente']);

        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'user' => $usuario,
            'token' => $token,
        ], 201);
    }


    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->password)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }

        if (!$usuario->activo) {
            throw ValidationException::withMessages([
                'email' => ['Esta cuenta está desactivada.'],
            ]);
        }


        $usuario->tokens()->delete();


        $token = $usuario->createToken('auth_token')->plainTextToken;


        $usuario->load(['agente', 'cliente']);

        return response()->json([
            'message' => 'Login exitoso',
            'user' => $usuario,
            'token' => $token,
        ]);
    }


    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout exitoso',
        ]);
    }


    public function me(Request $request): JsonResponse
    {
        $usuario = $request->user();
        $usuario->load(['agente', 'cliente']);

        return response()->json($usuario);
    }


    public function updateProfile(Request $request): JsonResponse
    {
        $usuario = $request->user();

        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id_usuario . ',id_usuario',
            'foto' => 'nullable|image|max:2048', 
            

            'dni' => 'required_if:tipo_usuario,agente|string|max:20',
            'direccion' => 'nullable|string|max:200',
        ]);


        if ($request->email !== $usuario->email) {
            $usuario->email = $request->email;
            $usuario->save();
        }


        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('perfiles', 'public');
            $usuario->foto_perfil = '/storage/' . $path;
            $usuario->save();
        }


        if ($usuario->tipo_usuario === 'agente') {
            $usuario->agente()->update([
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'telefono' => $request->telefono,
                'dni' => $request->dni ?? $usuario->agente->dni,
            ]);
        } else {
            $usuario->cliente()->update([
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion ?? $usuario->cliente->direccion,
            ]);
        }


        $usuario->load(['agente', 'cliente']);

        return response()->json([
            'message' => 'Perfil actualizado correctamente',
            'user' => $usuario,
        ]);
    }
}
