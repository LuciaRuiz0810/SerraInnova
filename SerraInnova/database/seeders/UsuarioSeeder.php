<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        Usuario::create([
            'email' => 'admin@inmobiliaria.com',
            'password' => Hash::make('password123'),
            'tipo_usuario' => 'administrador',
            'activo' => true,
        ]);

        Usuario::create([
            'email' => 'agente1@inmobiliaria.com',
            'password' => Hash::make('password123'),
            'tipo_usuario' => 'agente',
            'activo' => true,
        ]);

        Usuario::create([
            'email' => 'cliente1@email.com',
            'password' => Hash::make('password123'),
            'tipo_usuario' => 'cliente',
            'activo' => true,
        ]);
    }
}
