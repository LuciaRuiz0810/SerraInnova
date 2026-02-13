<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Propiedad;

class PropiedadSeeder extends Seeder
{
    public function run(): void
    {
        // Get available agents dynamically
        $agentes = \App\Models\Agente::all();
        
        // If no agents exist, we can't seed properties assigned to them properly,
        // but we'll try to handle it or just fail gracefully.
        if ($agentes->isEmpty()) {
            return;
        }

        // Helper to get a random agent ID
        $getAgentId = function() use ($agentes) {
            return $agentes->random()->id_agente;
        };

        // Propiedad 1: Apartamento céntrico en alquiler
        Propiedad::create([
            'id_agente' => $getAgentId(),
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
            'etiqueta_energetica' => 'B',
            'fuentes_energia' => json_encode(['aerotermia']),
            'fotos' => json_encode([
                'https://images.pexels.com/photos/1643383/pexels-photo-1643383.jpeg?auto=compress&cs=tinysrgb&w=800',
                'https://images.pexels.com/photos/1457842/pexels-photo-1457842.jpeg?auto=compress&cs=tinysrgb&w=800',
            ]),
        ]);

        // Propiedad 2: Chalet con piscina en venta
        Propiedad::create([
            'id_agente' => $getAgentId(),
            'titulo' => 'Chalet con piscina y jardín',
            'descripcion' => 'Espectacular chalet independiente con piscina privada, jardín y garaje para 2 coches',
            'tipo_propiedad' => 'casa',
            'tipo_operacion' => 'venta',
            'precio_venta' => 450000.00,
            'precio_alquiler' => null,
            'direccion' => 'Urbanización Los Pinos 12',
            'ciudad' => 'Paterna',
            'provincia' => 'Valencia',
            'codigo_postal' => '46980',
            'metros_cuadrados' => 250.00,
            'habitaciones' => 4,
            'banos' => 3,
            'garaje' => true,
            'jardin' => true,
            'piscina' => true,
            'ascensor' => false,
            'amueblado' => false,
            'estado' => 'disponible',
            'etiqueta_energetica' => 'A',
            'fuentes_energia' => json_encode(['placas_solares', 'aerotermia']),
            'fotos' => json_encode([
                'https://images.pexels.com/photos/1396122/pexels-photo-1396122.jpeg?auto=compress&cs=tinysrgb&w=800',
                'https://images.pexels.com/photos/1396132/pexels-photo-1396132.jpeg?auto=compress&cs=tinysrgb&w=800',
                'https://images.pexels.com/photos/2102587/pexels-photo-2102587.jpeg?auto=compress&cs=tinysrgb&w=800',
            ]),
        ]);

        // Propiedad 3: Piso moderno en venta
        Propiedad::create([
            'id_agente' => $getAgentId(),
            'titulo' => 'Piso moderno con terraza',
            'descripcion' => 'Piso de obra nueva con acabados de lujo, terraza de 30m² y vistas al mar',
            'tipo_propiedad' => 'apartamento',
            'tipo_operacion' => 'venta',
            'precio_venta' => 320000.00,
            'precio_alquiler' => null,
            'direccion' => 'Avenida del Puerto 89',
            'ciudad' => 'Valencia',
            'provincia' => 'Valencia',
            'codigo_postal' => '46011',
            'metros_cuadrados' => 120.00,
            'habitaciones' => 3,
            'banos' => 2,
            'garaje' => true,
            'jardin' => false,
            'piscina' => false,
            'ascensor' => true,
            'amueblado' => false,
            'estado' => 'disponible',
            'etiqueta_energetica' => 'A',
            'fuentes_energia' => json_encode(['placas_solares']),
            'fotos' => json_encode([
                'https://images.pexels.com/photos/1571460/pexels-photo-1571460.jpeg?auto=compress&cs=tinysrgb&w=800',
                'https://images.pexels.com/photos/1571463/pexels-photo-1571463.jpeg?auto=compress&cs=tinysrgb&w=800',
            ]),
        ]);

        // Propiedad 4: Casa rústica en alquiler
        Propiedad::create([
            'id_agente' => $getAgentId(),
            'titulo' => 'Casa rústica en el campo',
            'descripcion' => 'Encantadora casa de campo con chimenea, huerto y vistas a la montaña',
            'tipo_propiedad' => 'casa',
            'tipo_operacion' => 'alquiler',
            'precio_venta' => null,
            'precio_alquiler' => 1200.00,
            'direccion' => 'Camino de la Sierra s/n',
            'ciudad' => 'Chulilla',
            'provincia' => 'Valencia',
            'codigo_postal' => '46167',
            'metros_cuadrados' => 180.00,
            'habitaciones' => 3,
            'banos' => 2,
            'garaje' => true,
            'jardin' => true,
            'piscina' => false,
            'ascensor' => false,
            'amueblado' => true,
            'estado' => 'disponible',
            'etiqueta_energetica' => 'C',
            'fuentes_energia' => json_encode(['biomasa']),
            'fotos' => json_encode([
                'https://images.pexels.com/photos/2251247/pexels-photo-2251247.jpeg?auto=compress&cs=tinysrgb&w=800',
                'https://images.pexels.com/photos/2251252/pexels-photo-2251252.jpeg?auto=compress&cs=tinysrgb&w=800',
            ]),
        ]);

        // Propiedad 5: Apartamento playa en venta
        Propiedad::create([
            'id_agente' => $getAgentId(),
            'titulo' => 'Apartamento primera línea de playa',
            'descripcion' => 'Apartamento con vistas directas al mar, a 50 metros de la playa',
            'tipo_propiedad' => 'apartamento',
            'tipo_operacion' => 'venta',
            'precio_venta' => 280000.00,
            'precio_alquiler' => null,
            'direccion' => 'Paseo Marítimo 45',
            'ciudad' => 'Cullera',
            'provincia' => 'Valencia',
            'codigo_postal' => '46400',
            'metros_cuadrados' => 85.00,
            'habitaciones' => 2,
            'banos' => 1,
            'garaje' => true,
            'jardin' => false,
            'piscina' => true,
            'ascensor' => true,
            'amueblado' => true,
            'estado' => 'disponible',
            'etiqueta_energetica' => 'B',
            'fuentes_energia' => json_encode(['aerotermia']),
            'fotos' => json_encode([
                'https://images.pexels.com/photos/1743229/pexels-photo-1743229.jpeg?auto=compress&cs=tinysrgb&w=800',
                'https://images.pexels.com/photos/1743231/pexels-photo-1743231.jpeg?auto=compress&cs=tinysrgb&w=800',
            ]),
        ]);

        // Propiedad 6: Estudio en alquiler
        Propiedad::create([
            'id_agente' => $getAgentId(),
            'titulo' => 'Estudio luminoso cerca universidad',
            'descripcion' => 'Estudio ideal para estudiantes, totalmente amueblado y con todos los servicios',
            'tipo_propiedad' => 'apartamento',
            'tipo_operacion' => 'alquiler',
            'precio_venta' => null,
            'precio_alquiler' => 550.00,
            'direccion' => 'Calle Blasco Ibáñez 78',
            'ciudad' => 'Valencia',
            'provincia' => 'Valencia',
            'codigo_postal' => '46010',
            'metros_cuadrados' => 35.00,
            'habitaciones' => 1,
            'banos' => 1,
            'garaje' => false,
            'jardin' => false,
            'piscina' => false,
            'ascensor' => true,
            'amueblado' => true,
            'estado' => 'disponible',
            'etiqueta_energetica' => 'D',
            'fuentes_energia' => json_encode([]),
            'fotos' => json_encode([
                'https://images.pexels.com/photos/1457847/pexels-photo-1457847.jpeg?auto=compress&cs=tinysrgb&w=800',
            ]),
        ]);

        // Propiedad 7: Casa adosada en venta
        Propiedad::create([
            'id_agente' => $getAgentId(),
            'titulo' => 'Casa adosada con garaje',
            'descripcion' => 'Casa adosada en urbanización privada con zonas comunes, piscina y parque infantil',
            'tipo_propiedad' => 'casa',
            'tipo_operacion' => 'venta',
            'precio_venta' => 195000.00,
            'precio_alquiler' => null,
            'direccion' => 'Urbanización El Bosque 34',
            'ciudad' => 'Torrent',
            'provincia' => 'Valencia',
            'codigo_postal' => '46900',
            'metros_cuadrados' => 140.00,
            'habitaciones' => 3,
            'banos' => 2,
            'garaje' => true,
            'jardin' => true,
            'piscina' => true,
            'ascensor' => false,
            'amueblado' => false,
            'estado' => 'disponible',
            'etiqueta_energetica' => 'C',
            'fuentes_energia' => json_encode(['aerotermia']),
            'fotos' => json_encode([
                'https://images.pexels.com/photos/1438832/pexels-photo-1438832.jpeg?auto=compress&cs=tinysrgb&w=800',
                'https://images.pexels.com/photos/1438834/pexels-photo-1438834.jpeg?auto=compress&cs=tinysrgb&w=800',
            ]),
        ]);

        // Propiedad 8: Ático con terraza en alquiler
        Propiedad::create([
            'id_agente' => $getAgentId(),
            'titulo' => 'Ático con terraza panorámica',
            'descripcion' => 'Impresionante ático con terraza de 60m² y vistas 360° de la ciudad',
            'tipo_propiedad' => 'apartamento',
            'tipo_operacion' => 'alquiler',
            'precio_venta' => null,
            'precio_alquiler' => 1500.00,
            'direccion' => 'Calle Xàtiva 156',
            'ciudad' => 'Valencia',
            'provincia' => 'Valencia',
            'codigo_postal' => '46007',
            'metros_cuadrados' => 110.00,
            'habitaciones' => 3,
            'banos' => 2,
            'garaje' => true,
            'jardin' => false,
            'piscina' => false,
            'ascensor' => true,
            'amueblado' => false,
            'estado' => 'disponible',
            'etiqueta_energetica' => 'B',
            'fuentes_energia' => json_encode(['placas_solares']),
            'fotos' => json_encode([
                'https://images.pexels.com/photos/1571468/pexels-photo-1571468.jpeg?auto=compress&cs=tinysrgb&w=800',
                'https://images.pexels.com/photos/1571471/pexels-photo-1571471.jpeg?auto=compress&cs=tinysrgb&w=800',
                'https://images.pexels.com/photos/1571467/pexels-photo-1571467.jpeg?auto=compress&cs=tinysrgb&w=800',
            ]),
        ]);

        // Propiedad 9: Villa de lujo en venta
        Propiedad::create([
            'id_agente' => $getAgentId(),
            'titulo' => 'Villa de lujo con vistas al golf',
            'descripcion' => 'Exclusiva villa con diseño moderno, domótica, bodega y gimnasio privado',
            'tipo_propiedad' => 'casa',
            'tipo_operacion' => 'venta',
            'precio_venta' => 890000.00,
            'precio_alquiler' => null,
            'direccion' => 'Urbanización El Saler Golf 7',
            'ciudad' => 'El Saler',
            'provincia' => 'Valencia',
            'codigo_postal' => '46012',
            'metros_cuadrados' => 380.00,
            'habitaciones' => 5,
            'banos' => 4,
            'garaje' => true,
            'jardin' => true,
            'piscina' => true,
            'ascensor' => false,
            'amueblado' => true,
            'estado' => 'disponible',
            'etiqueta_energetica' => 'A',
            'fuentes_energia' => json_encode(['placas_solares', 'aerotermia', 'biomasa']),
            'fotos' => json_encode([
                'https://images.pexels.com/photos/1732414/pexels-photo-1732414.jpeg?auto=compress&cs=tinysrgb&w=800',
                'https://images.pexels.com/photos/1732418/pexels-photo-1732418.jpeg?auto=compress&cs=tinysrgb&w=800',
                'https://images.pexels.com/photos/1732421/pexels-photo-1732421.jpeg?auto=compress&cs=tinysrgb&w=800',
            ]),
        ]);

        // Propiedad 10: Piso para reformar en venta
        Propiedad::create([
            'id_agente' => $getAgentId(),
            'titulo' => 'Piso para reformar en zona tranquila',
            'descripcion' => 'Piso amplio para reformar a tu gusto, buena ubicación y mucho potencial',
            'tipo_propiedad' => 'apartamento',
            'tipo_operacion' => 'venta',
            'precio_venta' => 125000.00,
            'precio_alquiler' => null,
            'direccion' => 'Calle Sagunto 92',
            'ciudad' => 'Valencia',
            'provincia' => 'Valencia',
            'codigo_postal' => '46009',
            'metros_cuadrados' => 95.00,
            'habitaciones' => 3,
            'banos' => 1,
            'garaje' => false,
            'jardin' => false,
            'piscina' => false,
            'ascensor' => false,
            'amueblado' => false,
            'estado' => 'disponible',
            'etiqueta_energetica' => 'E',
            'fuentes_energia' => json_encode([]),
            'fotos' => json_encode([
                'https://images.pexels.com/photos/1648768/pexels-photo-1648768.jpeg?auto=compress&cs=tinysrgb&w=800',
            ]),
        ]);
    }
}
