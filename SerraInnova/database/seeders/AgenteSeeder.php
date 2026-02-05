<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agente;

class AgenteSeeder extends Seeder
{
    public function run(): void
    {
        Agente::create([
            'id_usuario' => 2, // agente1@inmobiliaria.com
            'nombre' => 'María',
            'apellidos' => 'García López',
            'telefono' => '+34 600111222',
            'dni' => '12345678A',
            'licencia' => 'LIC-001',
            'zona_trabajo' => 'Valencia Centro',
            'comision_porcentaje' => 3.00,
            'ventas_totales' => 0,
        ]);
    }
}
