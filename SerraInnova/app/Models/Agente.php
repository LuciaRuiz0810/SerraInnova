<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agente extends Model
{
    protected $table = 'agentes';
    protected $primaryKey = 'id_agente';
    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'nombre',
        'apellidos',
        'telefono',
        'dni',
        'licencia',
        'zona_trabajo',
        'comision_porcentaje',
        'ventas_totales',
    ];

    protected $casts = [
        'comision_porcentaje' => 'decimal:2',
        'ventas_totales' => 'integer',
    ];

    // Relaciones
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function propiedades(): HasMany
    {
        return $this->hasMany(Propiedad::class, 'id_agente', 'id_agente');
    }

    public function contratos(): HasMany
    {
        return $this->hasMany(Contrato::class, 'id_agente', 'id_agente');
    }
}
