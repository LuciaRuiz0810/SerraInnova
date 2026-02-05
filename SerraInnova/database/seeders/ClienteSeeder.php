<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        Cliente::create([
            'id_usuario' => 3, // cliente1@email.com
            'nombre' => 'Juan',
            'apellidos' => 'Pérez Martínez',
            'telefono' => '+34 611222333',
            'dni' => '87654321B',
            'direccion' => 'Calle Mayor 10, Valencia',
            'fecha_nacimiento' => '1990-05-15',
            'preferencias' => 'Busca apartamento céntrico, 2-3 habitaciones',
        ]);
    }
}
