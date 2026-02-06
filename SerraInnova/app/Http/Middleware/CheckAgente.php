<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAgente
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || $user->tipo_usuario !== 'agente') {
            return response()->json([
                'message' => 'No tienes permisos para acceder a este recurso. Solo agentes pueden realizar esta acción.'
            ], 403);
        }

        return $next($request);
    }
}
