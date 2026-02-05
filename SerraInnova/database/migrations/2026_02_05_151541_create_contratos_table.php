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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id('id_contrato');
            $table->foreignId('id_propiedad')->constrained('propiedades', 'id_propiedad')->onDelete('cascade');
            $table->foreignId('id_cliente')->constrained('clientes', 'id_cliente')->onDelete('cascade');
            $table->foreignId('id_agente')->nullable()->constrained('agentes', 'id_agente')->onDelete('set null');
            $table->enum('tipo_contrato', ['venta', 'alquiler']);
            $table->date('fecha_firma');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->decimal('precio_total', 12, 2);
            $table->enum('forma_pago', ['contado', 'financiado', 'mensual'])->default('contado');
            $table->decimal('deposito', 10, 2)->nullable();
            $table->text('clausulas')->nullable();
            $table->string('documento_pdf')->nullable();
            $table->enum('estado', ['borrador', 'firmado', 'activo', 'finalizado', 'cancelado'])->default('borrador');
            $table->text('notas')->nullable();
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->timestamp('fecha_actualizacion')->useCurrent()->useCurrentOnUpdate();
            
            $table->index('estado');
            $table->index('tipo_contrato');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
