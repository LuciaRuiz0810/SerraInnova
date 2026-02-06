<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user is created in AdminUserSeeder.php
        
        // Agents
        Usuario::create([
            'email' => 'agente1@inmobiliaria.com',
            'password' => Hash::make('password123'),
            'tipo_usuario' => 'agente',
            'activo' => true,
        ]);

        Usuario::create([
            'email' => 'agente2@inmobiliaria.com',
            'password' => Hash::make('password123'),
            'tipo_usuario' => 'agente',
            'activo' => true,
        ]);

        Usuario::create([
            'email' => 'agente3@inmobiliaria.com',
            'password' => Hash::make('password123'),
            'tipo_usuario' => 'agente',
            'activo' => true,
        ]);

        // Example client for testing
        Usuario::create([
            'email' => 'cliente1@email.com',
            'password' => Hash::make('password123'),
            'tipo_usuario' => 'cliente', // Match migration enum
            'activo' => true,
        ]);
    }
}
