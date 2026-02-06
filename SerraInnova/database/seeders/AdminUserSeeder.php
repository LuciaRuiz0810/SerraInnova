<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verificar si ya existe el admin para no duplicar
        if (!Usuario::where('email', 'admin@serrainnova.com')->exists()) {
            Usuario::create([
                'email' => 'admin@serrainnova.com',
                'password' => Hash::make('admin123'), // Contraseña por defecto
                'tipo_usuario' => 'administrador',
                'activo' => true,
            ]);
        }
    }
}
