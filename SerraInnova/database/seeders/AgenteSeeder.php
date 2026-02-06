<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agente;

class AgenteSeeder extends Seeder
{
    public function run(): void
    {
        // Agente 1: María García López
        $user1 = \App\Models\Usuario::where('email', 'agente1@inmobiliaria.com')->first();
        if ($user1) {
            Agente::create([
                'id_usuario' => $user1->id_usuario,
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

        // Agente 2: Carlos Martínez Ruiz
        $user2 = \App\Models\Usuario::where('email', 'agente2@inmobiliaria.com')->first();
        if ($user2) {
            Agente::create([
                'id_usuario' => $user2->id_usuario,
                'nombre' => 'Carlos',
                'apellidos' => 'Martínez Ruiz',
                'telefono' => '+34 600222333',
                'dni' => '23456789B',
                'licencia' => 'LIC-002',
                'zona_trabajo' => 'Valencia Norte',
                'comision_porcentaje' => 3.50,
                'ventas_totales' => 0,
            ]);
        }

        // Agente 3: Ana Fernández Torres
        $user3 = \App\Models\Usuario::where('email', 'agente3@inmobiliaria.com')->first();
        if ($user3) {
            Agente::create([
                'id_usuario' => $user3->id_usuario,
                'nombre' => 'Ana',
                'apellidos' => 'Fernández Torres',
                'telefono' => '+34 600333444',
                'dni' => '34567890C',
                'licencia' => 'LIC-003',
                'zona_trabajo' => 'Valencia Sur',
                'comision_porcentaje' => 2.80,
                'ventas_totales' => 0,
            ]);
        }
    }
}
