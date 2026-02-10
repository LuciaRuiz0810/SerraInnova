<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Verificando imágenes de los artículos:\n\n";

$articulos = \App\Models\Articulo::all();

foreach ($articulos as $articulo) {
    $esPexels = str_contains($articulo->imagen_destacada, 'pexels.com') ? '✓ Pexels' : '✗ Unsplash';
    echo "{$esPexels} - {$articulo->titulo}\n";
    echo "   URL: {$articulo->imagen_destacada}\n\n";
}

$totalPexels = $articulos->filter(fn($a) => str_contains($a->imagen_destacada, 'pexels.com'))->count();
$total = $articulos->count();

echo "Resumen: {$totalPexels}/{$total} artículos usando Pexels\n";
