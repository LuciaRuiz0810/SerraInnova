<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Nuevas URLs de Pexels
$imagenes = [
    'como-ahorrar-en-la-factura-de-luz-con-paneles-solares' => 'https://images.pexels.com/photos/433308/pexels-photo-433308.jpeg?auto=compress&cs=tinysrgb&w=800',
    'guia-completa-de-subvenciones-2026-para-energia-renovable' => 'https://images.pexels.com/photos/259027/pexels-photo-259027.jpeg?auto=compress&cs=tinysrgb&w=800',
    'domotica-verde-tecnologia-para-un-hogar-sostenible' => 'https://images.pexels.com/photos/1571460/pexels-photo-1571460.jpeg?auto=compress&cs=tinysrgb&w=800',
    'agenda-2030-objetivos-de-desarrollo-sostenible-en-el-sector-inmobiliario' => 'https://images.pexels.com/photos/280221/pexels-photo-280221.jpeg?auto=compress&cs=tinysrgb&w=800',
    'como-reducir-el-consumo-de-agua-en-tu-hogar' => 'https://images.pexels.com/photos/416528/pexels-photo-416528.jpeg?auto=compress&cs=tinysrgb&w=800',
];

foreach ($imagenes as $slug => $imagen) {
    $articulo = \App\Models\Articulo::where('slug', $slug)->first();
    if ($articulo) {
        $articulo->imagen_destacada = $imagen;
        $articulo->save();
        echo "✓ Actualizado: {$articulo->titulo}\n";
    } else {
        echo "✗ No encontrado: {$slug}\n";
    }
}

echo "\n¡Imágenes actualizadas correctamente!\n";
