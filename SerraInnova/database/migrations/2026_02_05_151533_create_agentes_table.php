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
        Schema::create('agentes', function (Blueprint $table) {
            $table->id('id_agente');
            $table->foreignId('id_usuario')->nullable()->constrained('usuarios', 'id_usuario')->onDelete('cascade');
            $table->string('nombre', 100);
            $table->string('apellidos', 100);
            $table->string('telefono', 20)->nullable();
            $table->string('dni', 20)->unique()->nullable();
            $table->string('licencia', 50)->nullable();
            $table->string('zona_trabajo', 100)->nullable();
            $table->decimal('comision_porcentaje', 5, 2)->default(3.00);
            $table->integer('ventas_totales')->default(0);
            
            $table->index('dni');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agentes');
    }
};
