<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contrato extends Model
{
    protected $table = 'contratos';
    protected $primaryKey = 'id_contrato';
    public $timestamps = false;

    protected $fillable = [
        'id_propiedad',
        'id_cliente',
        'id_agente',
        'tipo_contrato',
        'fecha_firma',
        'fecha_inicio',
        'fecha_fin',
        'precio_total',
        'forma_pago',
        'deposito',
        'clausulas',
        'documento_pdf',
        'estado',
        'notas',
    ];

    protected $casts = [
        'fecha_firma' => 'date',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'precio_total' => 'decimal:2',
        'deposito' => 'decimal:2',
        'fecha_creacion' => 'datetime',
        'fecha_actualizacion' => 'datetime',
    ];

    // Relaciones
    public function propiedad(): BelongsTo
    {
        return $this->belongsTo(Propiedad::class, 'id_propiedad', 'id_propiedad');
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function agente(): BelongsTo
    {
        return $this->belongsTo(Agente::class, 'id_agente', 'id_agente');
    }
}
