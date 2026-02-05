<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contrato;

class ContratoSeeder extends Seeder
{
    public function run(): void
    {
        Contrato::create([
            'id_propiedad' => 1,
            'id_cliente' => 1,
            'id_agente' => 1,
            'tipo_contrato' => 'alquiler',
            'fecha_firma' => '2026-01-15',
            'fecha_inicio' => '2026-02-01',
            'fecha_fin' => '2027-02-01',
            'precio_total' => 10200.00,
            'forma_pago' => 'mensual',
            'deposito' => 1700.00,
            'clausulas' => 'Contrato de alquiler estándar. Duración 12 meses renovable.',
            'documento_pdf' => null,
            'estado' => 'activo',
            'notas' => 'Cliente puntual, buen historial',
        ]);
    }
}
