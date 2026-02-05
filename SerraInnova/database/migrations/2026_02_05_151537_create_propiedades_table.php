<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('propiedades', function (Blueprint $table) {
            $table->id('id_propiedad');
            $table->foreignId('id_agente')->nullable()->constrained('agentes', 'id_agente')->onDelete('set null');
            $table->string('titulo', 200);
            $table->text('descripcion')->nullable();
            $table->enum('tipo_propiedad', ['casa', 'apartamento', 'local', 'terreno', 'oficina']);
            $table->enum('tipo_operacion', ['venta', 'alquiler', 'ambos']);
            $table->decimal('precio_venta', 12, 2)->nullable();
            $table->decimal('precio_alquiler', 10, 2)->nullable();
            $table->string('direccion', 200);
            $table->string('ciudad', 100);
            $table->string('provincia', 100)->nullable();
            $table->string('codigo_postal', 10)->nullable();
            $table->decimal('metros_cuadrados', 8, 2)->nullable();
            $table->integer('habitaciones')->nullable();
            $table->integer('banos')->nullable();
            $table->boolean('garaje')->default(false);
            $table->boolean('jardin')->default(false);
            $table->boolean('piscina')->default(false);
            $table->boolean('ascensor')->default(false);
            $table->boolean('amueblado')->default(false);
            $table->enum('estado', ['disponible', 'reservado', 'vendido', 'alquilado'])->default('disponible');
            $table->timestamp('fecha_publicacion')->useCurrent();
            $table->json('fotos')->nullable();
            
            $table->index('ciudad');
            $table->index('tipo_propiedad');
            $table->index('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propiedades');
    }
};
