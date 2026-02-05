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
            $table->enum('certificacion_energetica', ['A', 'B', 'C', 'D', 'E', 'F', 'G'])->nullable();
            $table->decimal('huella_carbono_anual', 8, 2)->nullable()->comment('kg CO2/año');
            $table->string('tipo_energia')->nullable()->comment('aerotermia, solar, biomasa, gas, eléctrico');
            $table->json('materiales_construccion')->nullable();
            $table->json('certificaciones')->nullable()->comment('BREEAM, LEED, Passivhaus');
            $table->decimal('ahorro_co2_vs_estandar', 8, 2)->nullable()->comment('kg CO2/año ahorrados');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('propiedades', function (Blueprint $table) {
            $table->dropColumn([
                'certificacion_energetica',
                'huella_carbono_anual',
                'tipo_energia',
                'materiales_construccion',
                'certificaciones',
                'ahorro_co2_vs_estandar',
            ]);
        });
    }
};
