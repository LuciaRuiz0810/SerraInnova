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
        Schema::create('caracteristicas_sostenibles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('propiedad_id')->constrained('propiedades', 'id_propiedad')->onDelete('cascade');
            
            // Aislamiento
            $table->boolean('aislamiento_termico')->default(false);
            $table->boolean('ventanas_climalit')->default(false);
            $table->boolean('sistema_sate')->default(false);
            
            // Energía
            $table->boolean('aerotermia')->default(false);
            $table->boolean('placas_solares')->default(false);
            
            // Agua
            $table->boolean('recuperacion_pluviales')->default(false);
            
            // Materiales
            $table->boolean('pinturas_ecologicas')->default(false);
            $table->boolean('maderas_certificadas')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caracteristicas_sostenibles');
    }
};
