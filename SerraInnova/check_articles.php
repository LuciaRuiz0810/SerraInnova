<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$articulos = \App\Models\Articulo::select('titulo', 'categoria', 'publicado')->get();

echo "Total de artículos: " . $articulos->count() . PHP_EOL;
echo "Publicados: " . $articulos->where('publicado', true)->count() . PHP_EOL . PHP_EOL;

echo "Artículos en la base de datos:" . PHP_EOL;
foreach ($articulos as $articulo) {
    $status = $articulo->publicado ? '✓ Publicado' : '✗ Borrador';
    echo "- [{$status}] {$articulo->titulo} [{$articulo->categoria}]" . PHP_EOL;
}
