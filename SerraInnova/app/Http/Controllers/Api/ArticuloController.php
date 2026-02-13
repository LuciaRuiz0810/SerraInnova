<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticuloController extends Controller
{
   
    public function index(Request $request)
    {
        $query = Articulo::with('autor.agente', 'autor.cliente')
            ->where('publicado', true)
            ->orderBy('fecha_publicacion', 'desc');


        if ($request->has('categoria') && $request->categoria !== 'todas') {
            $query->where('categoria', $request->categoria);
        }


        if ($request->has('buscar')) {
            $buscar = $request->buscar;
            $query->where(function($q) use ($buscar) {
                $q->where('titulo', 'like', "%{$buscar}%")
                  ->orWhere('contenido', 'like', "%{$buscar}%")
                  ->orWhere('extracto', 'like', "%{$buscar}%");
            });
        }

        return response()->json($query->paginate(9));
    }


    public function show($slug)
    {
        $articulo = Articulo::with('autor.agente', 'autor.cliente')
            ->where('slug', $slug)
            ->where('publicado', true)
            ->firstOrFail();

        return response()->json($articulo);
    }


    public function admin(Request $request)
    {
        $query = Articulo::with('autor.agente', 'autor.cliente')
            ->orderBy('created_at', 'desc');


        if ($request->has('buscar')) {
            $buscar = $request->buscar;
            $query->where(function($q) use ($buscar) {
                $q->where('titulo', 'like', "%{$buscar}%")
                  ->orWhere('contenido', 'like', "%{$buscar}%");
            });
        }

        return response()->json($query->paginate(15));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'extracto' => 'nullable|string',
            'imagen_destacada' => 'nullable|string',
            'categoria' => 'required|in:ahorro_energetico,agenda_2030,subvenciones,domotica_verde,general',
            'publicado' => 'boolean',
        ]);


        $validated['slug'] = Str::slug($validated['titulo']);
        

        $validated['autor_id'] = auth()->user()->id_usuario;
        

        if ($validated['publicado'] ?? false) {
            $validated['fecha_publicacion'] = now();
        }

        $articulo = Articulo::create($validated);

        return response()->json($articulo->load('autor'), 201);
    }

   
    public function update(Request $request, $id)
    {
        $articulo = Articulo::findOrFail($id);

        $validated = $request->validate([
            'titulo' => 'sometimes|required|string|max:255',
            'contenido' => 'sometimes|required|string',
            'extracto' => 'nullable|string',
            'imagen_destacada' => 'nullable|string',
            'categoria' => 'sometimes|required|in:ahorro_energetico,agenda_2030,subvenciones,domotica_verde,general',
            'publicado' => 'boolean',
        ]);


        if (isset($validated['titulo']) && $validated['titulo'] !== $articulo->titulo) {
            $validated['slug'] = Str::slug($validated['titulo']);
        }


        if (($validated['publicado'] ?? false) && !$articulo->publicado) {
            $validated['fecha_publicacion'] = now();
        }

        $articulo->update($validated);

        return response()->json($articulo->load('autor'));
    }

    public function destroy($id)
    {
        $articulo = Articulo::findOrFail($id);
        $articulo->delete();

        return response()->json(['message' => 'Artículo eliminado correctamente']);
    }
}
