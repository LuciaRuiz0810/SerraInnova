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
        'certificacion_energetica',
        'huella_carbono_anual',
        'tipo_energia',
        'materiales_construccion',
        'certificaciones',
        'ahorro_co2_vs_estandar',
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
        'huella_carbono_anual' => 'decimal:2',
        'ahorro_co2_vs_estandar' => 'decimal:2',
        'materiales_construccion' => 'array',
        'certificaciones' => 'array',
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

    public function caracteristicasSostenibles(): HasOne
    {
        return $this->hasOne(CaracteristicaSostenible::class, 'propiedad_id', 'id_propiedad');
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
        return $colors[$this->certificacion_energetica] ?? '#cccccc';
    }
}
