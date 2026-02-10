<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $fillable = [
        'titulo',
        'slug',
        'contenido',
        'extracto',
        'imagen_destacada',
        'categoria',
        'autor_id',
        'publicado',
        'fecha_publicacion',
    ];

    protected $casts = [
        'publicado' => 'boolean',
        'fecha_publicacion' => 'datetime',
    ];

    // Relación con el autor
    public function autor()
    {
        return $this->belongsTo(Usuario::class, 'autor_id', 'id_usuario');
    }

    // Accessor para la fecha formateada
    public function getFechaFormateadaAttribute()
    {
        return $this->fecha_publicacion?->format('d/m/Y');
    }
}
