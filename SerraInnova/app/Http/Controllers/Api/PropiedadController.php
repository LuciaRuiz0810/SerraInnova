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
    /**
     * Obtener listado de propiedades con filtros opcionales.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Propiedad::with(['agente.usuario']);

        // Filtrar solo disponibles (excluir vendidas) si no es admin
        if (!$request->user() || $request->user()->tipo_usuario !== 'administrador') {
            $query->where(function($q) {
                $q->where('estado', 'disponible')
                  ->orWhere('estado', 'reservado');
            });
        }

        // Filtros (igual que antes) ...
        if ($request->has('ubicacion') && $request->ubicacion) {
            $query->where('ciudad', 'like', '%' . $request->ubicacion . '%');
        }
        if ($request->has('tipo') && $request->tipo) {
            $query->where('tipo_propiedad', $request->tipo);
        }
        if ($request->has('operacion') && $request->operacion) {
            $query->where('tipo_operacion', $request->operacion);
        }
        if ($request->has('certificacion') && $request->certificacion) {
            $query->where('etiqueta_energetica', $request->certificacion);
        }
        if ($request->has('tipo_energia') && $request->tipo_energia) {
            $query->whereRaw('JSON_EXTRACT(fuentes_energia, "$.' . $request->tipo_energia . '") = true');
        }

        $propiedades = $query->latest('fecha_publicacion')->get();

        return response()->json($propiedades);
    }

    /**
     * Obtener propiedades destacadas (últimas 3).
     */
    public function featured(): JsonResponse
    {
        $propiedades = Propiedad::with(['agente.usuario'])
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
     * Obtener todas las propiedades para admin (sin filtros de estado).
     */
    public function indexAdmin(Request $request): JsonResponse
    {
        // Verificar rol
        if (!$request->user() || $request->user()->tipo_usuario !== 'administrador') {
             return response()->json(['message' => 'No autorizado'], 403);
        }

        $query = Propiedad::with(['agente.usuario']);
        
        $propiedades = $query->latest('fecha_publicacion')->get();

        return response()->json($propiedades);
    }

    /**
     * Crear una nueva propiedad (agentes y admins).
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'titulo' => 'required|string|max:200',
            'descripcion' => 'nullable|string',
            'tipo_propiedad' => 'required|in:casa,apartamento,local,terreno,oficina',
            'tipo_operacion' => 'required|in:venta,alquiler,ambos',
            'precio_venta' => 'nullable|numeric|min:0',
            'precio_alquiler' => 'nullable|numeric|min:0',
            'direccion' => 'required|string|max:200',
            'ciudad' => 'required|string|max:100',
            'provincia' => 'nullable|string|max:100',
            'codigo_postal' => 'nullable|string|max:10',
            'metros_cuadrados' => 'nullable|numeric|min:0',
            'habitaciones' => 'nullable|integer|min:0',
            'banos' => 'nullable|integer|min:0',
            'garaje' => 'boolean',
            'jardin' => 'boolean',
            'piscina' => 'boolean',
            'ascensor' => 'boolean',
            'amueblado' => 'boolean',
            
            // Archivos
            'certificado_energetico' => 'nullable|file|mimes:pdf|max:51200', // 50MB
            'galeria' => 'nullable|array',
            'galeria.*' => 'image|max:10240', // 10MB por imagen

            // Sostenibilidad
            'etiqueta_energetica' => 'nullable|in:A,B,C,D,E,F,G',
            'huella_carbono_anual' => 'nullable|numeric|min:0',
            'ahorro_co2_estimado' => 'nullable|numeric|min:0',
            'aislamiento_termico' => 'nullable|string', // JSON string from form
            'fuentes_energia' => 'nullable|string',
            'consumo_agua' => 'nullable|string',
            'materiales_sostenibles' => 'nullable|string',
            'certificacion_breeam' => 'nullable', // Allow relaxed validation as we cast later
            'certificacion_leed' => 'nullable',
            'certificacion_passivhaus' => 'nullable',
        ]);

        $agente = $request->user()->agente;
        $agenteId = $agente ? $agente->id_agente : null;

        // Crear Propiedad
        $propiedad = new Propiedad();
        $propiedad->id_agente = $agenteId;
        $propiedad->titulo = $request->titulo;
        $propiedad->descripcion = $request->descripcion;
        $propiedad->tipo_propiedad = $request->tipo_propiedad;
        $propiedad->tipo_operacion = $request->tipo_operacion;
        $propiedad->precio_venta = $request->filled('precio_venta') ? $request->precio_venta : null;
        $propiedad->precio_alquiler = $request->filled('precio_alquiler') ? $request->precio_alquiler : null;
        $propiedad->direccion = $request->direccion;
        $propiedad->ciudad = $request->ciudad;
        $propiedad->provincia = $request->provincia;
        $propiedad->codigo_postal = $request->codigo_postal;
        $propiedad->metros_cuadrados = $request->filled('metros_cuadrados') ? $request->metros_cuadrados : null;
        $propiedad->habitaciones = $request->filled('habitaciones') ? $request->habitaciones : null;
        $propiedad->banos = $request->filled('banos') ? $request->banos : null;
        
        // Booleans: Force 1 or 0
        $propiedad->garaje = filter_var($request->garaje, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $propiedad->jardin = filter_var($request->jardin, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $propiedad->piscina = filter_var($request->piscina, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $propiedad->ascensor = filter_var($request->ascensor, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $propiedad->amueblado = filter_var($request->amueblado, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $propiedad->estado = 'disponible';

        // Sostenibilidad
        $propiedad->etiqueta_energetica = $request->filled('etiqueta_energetica') ? $request->etiqueta_energetica : null;
        $propiedad->huella_carbono_anual = $request->filled('huella_carbono_anual') ? $request->huella_carbono_anual : null;
        $propiedad->ahorro_co2_estimado = $request->filled('ahorro_co2_estimado') ? $request->ahorro_co2_estimado : null;
        
        // Parsear JSONs si vienen como strings
        $propiedad->aislamiento_termico = $request->aislamiento_termico ? json_decode($request->aislamiento_termico, true) : null;
        $propiedad->fuentes_energia = $request->fuentes_energia ? json_decode($request->fuentes_energia, true) : null;
        $propiedad->consumo_agua = $request->consumo_agua ? json_decode($request->consumo_agua, true) : null;
        $propiedad->materiales_sostenibles = $request->materiales_sostenibles ? json_decode($request->materiales_sostenibles, true) : null;
        
        $propiedad->certificacion_breeam = filter_var($request->certificacion_breeam, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $propiedad->certificacion_leed = filter_var($request->certificacion_leed, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $propiedad->certificacion_passivhaus = filter_var($request->certificacion_passivhaus, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;

        // Subir PDF Certificado
        if ($request->hasFile('certificado_energetico')) {
            $path = $request->file('certificado_energetico')->store('certificados', 'public');
            $propiedad->certificado_energetico_pdf = '/storage/' . $path;
        }

        // Subir Galería (Save directly to photos JSON)
        $fotos = [];
        if ($request->hasFile('galeria')) {
            foreach ($request->file('galeria') as $image) {
                $path = $image->store('propiedades', 'public');
                $fotos[] = '/storage/' . $path;
            }
        }
        $propiedad->fotos = !empty($fotos) ? $fotos : null;

        $propiedad->save();

        return response()->json([
            'message' => 'Propiedad creada exitosamente',
            'propiedad' => $propiedad,
        ], 201);
    }

    /**
     * Mostrar una propiedad específica.
     */
    public function show($id): JsonResponse
    {
        $propiedad = Propiedad::with(['agente.usuario', 'contratos'])
            ->findOrFail($id);

        return response()->json($propiedad);
    }

    /**
     * Actualizar una propiedad existente.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $propiedad = Propiedad::findOrFail($id);
        
        // Verificar permisos (Admin o Agente dueño)
        $user = $request->user();
        if ($user->tipo_usuario !== 'administrador' && $propiedad->id_agente !== $user->agente?->id_agente) {
             return response()->json(['message' => 'No autorizado'], 403);
        }

        // Validación similar a store pero con 'sometimes'
        $request->validate([
            'titulo' => 'sometimes|string|max:200',
            // ... (simplificado para brevedad)
            'certificado_energetico' => 'nullable|file|mimes:pdf|max:51200', // 50MB
        ]);

        // Excluir campos manuales
        $propiedad->fill($request->except([
            'galeria', 
            'certificado_energetico', 
            'aislamiento_termico', 
            'fuentes_energia', 
            'consumo_agua', 
            'materiales_sostenibles',
            'garaje', 'jardin', 'piscina', 'ascensor', 'amueblado',
            'certificacion_breeam', 'certificacion_leed', 'certificacion_passivhaus'
        ]));

        // Actualizar JSONs
        if ($request->has('aislamiento_termico')) $propiedad->aislamiento_termico = json_decode($request->aislamiento_termico, true);
        if ($request->has('fuentes_energia')) $propiedad->fuentes_energia = json_decode($request->fuentes_energia, true);
        if ($request->has('consumo_agua')) $propiedad->consumo_agua = json_decode($request->consumo_agua, true);
        if ($request->has('materiales_sostenibles')) $propiedad->materiales_sostenibles = json_decode($request->materiales_sostenibles, true);
        
        // Booleans
        if ($request->has('garaje')) $propiedad->garaje = filter_var($request->garaje, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        if ($request->has('jardin')) $propiedad->jardin = filter_var($request->jardin, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        if ($request->has('piscina')) $propiedad->piscina = filter_var($request->piscina, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        if ($request->has('ascensor')) $propiedad->ascensor = filter_var($request->ascensor, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        if ($request->has('amueblado')) $propiedad->amueblado = filter_var($request->amueblado, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        
        // Sostenibilidad Booleans
        if ($request->has('certificacion_breeam')) $propiedad->certificacion_breeam = filter_var($request->certificacion_breeam, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        if ($request->has('certificacion_leed')) $propiedad->certificacion_leed = filter_var($request->certificacion_leed, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        if ($request->has('certificacion_passivhaus')) $propiedad->certificacion_passivhaus = filter_var($request->certificacion_passivhaus, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;

        // Subir PDF (reemplazo)
        if ($request->hasFile('certificado_energetico')) {
            $path = $request->file('certificado_energetico')->store('certificados', 'public');
            $propiedad->certificado_energetico_pdf = '/storage/' . $path;
        }

        // Subir Nuevas Imágenes (Append to existing photos JSON)
        if ($request->hasFile('galeria')) {
            $currentPhotos = $propiedad->fotos ?? [];
            foreach ($request->file('galeria') as $image) {
                $path = $image->store('propiedades/' . $propiedad->id_propiedad, 'public');
                $currentPhotos[] = '/storage/' . $path;
            }
            $propiedad->fotos = $currentPhotos;
        }
        
        $propiedad->save();

        return response()->json([
            'message' => 'Propiedad actualizada exitosamente',
            'propiedad' => $propiedad,
        ]);
    }

    /**
     * Eliminar una propiedad.
     */
    public function destroy(Request $request, $id): JsonResponse
    {
         $propiedad = Propiedad::findOrFail($id);

         // Verificar permisos
         $user = $request->user();
         if ($user->tipo_usuario !== 'administrador' && $propiedad->id_agente !== $user->agente?->id_agente) {
              return response()->json(['message' => 'No autorizado'], 403);
         }

         // Laravel boot events or cascade DB constraints handle relations normally, 
         // but files need manual cleanup or observer. For now simple delete.
         $propiedad->delete();

         return response()->json(['message' => 'Propiedad eliminada correctamente']);
    }
}

