<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Propiedad extends Model
{
    protected $table = 'propiedades';
    protected $primaryKey = 'id_propiedad';
    public $timestamps = false;

    protected $fillable = [
        'id_agente',
        'titulo',
        'descripcion',
        'tipo_propiedad',
        'tipo_operacion',
        'precio_venta',
        'precio_alquiler',
        'direccion',
        'ciudad',
        'provincia',
        'codigo_postal',
        'metros_cuadrados',
        'habitaciones',
        'banos',
        'garaje',
        'jardin',
        'piscina',
        'ascensor',
        'amueblado',
        'estado',
        'fotos',
        // Campos de sostenibilidad
        'etiqueta_energetica',
        'huella_carbono_anual',
        'aislamiento_termico',
        'fuentes_energia',
        'consumo_agua',
        'materiales_sostenibles',
        'certificacion_breeam',
        'certificacion_leed',
        'certificacion_passivhaus',
        'ahorro_co2_estimado',
        // Documentación
        'certificado_energetico_pdf',
        'otros_documentos',
    ];

    protected $casts = [
        'precio_venta' => 'decimal:2',
        'precio_alquiler' => 'decimal:2',
        'metros_cuadrados' => 'decimal:2',
        'habitaciones' => 'integer',
        'banos' => 'integer',
        'garaje' => 'boolean',
        'jardin' => 'boolean',
        'piscina' => 'boolean',
        'ascensor' => 'boolean',
        'amueblado' => 'boolean',
        'fecha_publicacion' => 'datetime',
        'fotos' => 'array',
        // Campos de sostenibilidad
        'huella_carbono_anual' => 'decimal:2',
        'ahorro_co2_estimado' => 'decimal:2',
        'aislamiento_termico' => 'array',
        'fuentes_energia' => 'array',
        'consumo_agua' => 'array',
        'materiales_sostenibles' => 'array',
        'certificacion_breeam' => 'boolean',
        'certificacion_leed' => 'boolean',
        'certificacion_passivhaus' => 'boolean',
        'otros_documentos' => 'array',
    ];

    // Relaciones
    public function agente(): BelongsTo
    {
        return $this->belongsTo(Agente::class, 'id_agente', 'id_agente');
    }

    public function contratos(): HasMany
    {
        return $this->hasMany(Contrato::class, 'id_propiedad', 'id_propiedad');
    }



    // Scopes
    public function scopeDisponibles($query)
    {
        return $query->where('estado', 'disponible');
    }

    // Accessors
    public function getCertificacionColorAttribute()
    {
        $colors = [
            'A' => '#13ec5b',
            'B' => '#4c9a66',
            'C' => '#f4e04d',
            'D' => '#f9a825',
            'E' => '#ff8c00',
            'F' => '#ff6347',
            'G' => '#dc143c',
        ];
        return $colors[$this->etiqueta_energetica] ?? '#cccccc';
    }
}
