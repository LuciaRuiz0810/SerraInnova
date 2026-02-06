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
        Schema::table('propiedades', function (Blueprint $table) {
            // Eficiencia Energética
            if (!Schema::hasColumn('propiedades', 'etiqueta_energetica')) {
                $table->enum('etiqueta_energetica', ['A', 'B', 'C', 'D', 'E', 'F', 'G'])->nullable()->after('estado');
            }
            if (!Schema::hasColumn('propiedades', 'huella_carbono_anual')) {
                $table->decimal('huella_carbono_anual', 10, 2)->nullable()->comment('kg CO2/año')->after('etiqueta_energetica');
            }
            
            // Checklist de Sostenibilidad (JSON)
            if (!Schema::hasColumn('propiedades', 'aislamiento_termico')) {
                $table->json('aislamiento_termico')->nullable()->comment('ventanas_climalit, sate')->after('huella_carbono_anual');
            }
            if (!Schema::hasColumn('propiedades', 'fuentes_energia')) {
                $table->json('fuentes_energia')->nullable()->comment('aerotermia, placas_solares, biomasa')->after('aislamiento_termico');
            }
            if (!Schema::hasColumn('propiedades', 'consumo_agua')) {
                $table->json('consumo_agua')->nullable()->comment('recuperacion_pluviales')->after('fuentes_energia');
            }
            if (!Schema::hasColumn('propiedades', 'materiales_sostenibles')) {
                $table->json('materiales_sostenibles')->nullable()->comment('maderas_certificadas, pinturas_ecologicas')->after('consumo_agua');
            }
            
            // Certificaciones Externas
            if (!Schema::hasColumn('propiedades', 'certificacion_breeam')) {
                $table->boolean('certificacion_breeam')->default(false)->after('materiales_sostenibles');
            }
            if (!Schema::hasColumn('propiedades', 'certificacion_leed')) {
                $table->boolean('certificacion_leed')->default(false)->after('certificacion_breeam');
            }
            if (!Schema::hasColumn('propiedades', 'certificacion_passivhaus')) {
                $table->boolean('certificacion_passivhaus')->default(false)->after('certificacion_leed');
            }
            
            // Ahorro Estimado
            if (!Schema::hasColumn('propiedades', 'ahorro_co2_estimado')) {
                $table->decimal('ahorro_co2_estimado', 10, 2)->nullable()->comment('kg CO2/año ahorrados vs vivienda estándar')->after('certificacion_passivhaus');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('propiedades', function (Blueprint $table) {
            $table->dropColumn([
                'etiqueta_energetica',
                'huella_carbono_anual',
                'aislamiento_termico',
                'fuentes_energia',
                'consumo_agua',
                'materiales_sostenibles',
                'certificacion_breeam',
                'certificacion_leed',
                'certificacion_passivhaus',
                'ahorro_co2_estimado'
            ]);
        });
    }
};
