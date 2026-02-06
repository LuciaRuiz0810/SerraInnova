<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropiedadImagen extends Model
{
    protected $table = 'propiedad_imagenes';
    
    protected $fillable = [
        'id_propiedad',
        'url',
        'orden'
    ];

    public function propiedad(): BelongsTo
    {
        return $this->belongsTo(Propiedad::class, 'id_propiedad', 'id_propiedad');
    }
}
