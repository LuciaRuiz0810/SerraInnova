<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Propiedad;

class PropiedadSeeder extends Seeder
{
    public function run(): void
    {
        Propiedad::create([
            'id_agente' => 1,
            'titulo' => 'Apartamento céntrico',
            'descripcion' => 'Bonito apartamento en el centro de Valencia, completamente reformado',
            'tipo_propiedad' => 'apartamento',
            'tipo_operacion' => 'alquiler',
            'precio_venta' => null,
            'precio_alquiler' => 850.00,
            'direccion' => 'Calle Colón 25',
            'ciudad' => 'Valencia',
            'provincia' => 'Valencia',
            'codigo_postal' => '46004',
            'metros_cuadrados' => 75.00,
            'habitaciones' => 2,
            'banos' => 1,
            'garaje' => false,
            'jardin' => false,
            'piscina' => false,
            'ascensor' => true,
            'amueblado' => true,
            'estado' => 'disponible',
            'fotos' => json_encode([
                '/images/propiedades/apartamento1_1.jpg',
                '/images/propiedades/apartamento1_2.jpg',
            ]),
        ]);
    }
}
