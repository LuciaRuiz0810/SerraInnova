<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens;
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'email',
        'password',
        'tipo_usuario',
        'activo',
        'foto_perfil',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'fecha_registro' => 'datetime',
    ];

    // Relaciones
    public function cliente(): HasOne
    {
        return $this->hasOne(Cliente::class, 'id_usuario', 'id_usuario');
    }

    public function agente(): HasOne
    {
        return $this->hasOne(Agente::class, 'id_usuario', 'id_usuario');
    }
}
