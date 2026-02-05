<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CaracteristicaSostenible extends Model
{
    protected $table = 'caracteristicas_sostenibles';

    protected $fillable = [
        'propiedad_id',
        'aislamiento_termico',
        'ventanas_climalit',
        'sistema_sate',
        'aerotermia',
        'placas_solares',
        'recuperacion_pluviales',
        'pinturas_ecologicas',
        'maderas_certificadas',
    ];

    protected $casts = [
        'aislamiento_termico' => 'boolean',
        'ventanas_climalit' => 'boolean',
        'sistema_sate' => 'boolean',
        'aerotermia' => 'boolean',
        'placas_solares' => 'boolean',
        'recuperacion_pluviales' => 'boolean',
        'pinturas_ecologicas' => 'boolean',
        'maderas_certificadas' => 'boolean',
    ];

    // Relaciones
    public function propiedad(): BelongsTo
    {
        return $this->belongsTo(Propiedad::class, 'propiedad_id', 'id_propiedad');
    }
}
