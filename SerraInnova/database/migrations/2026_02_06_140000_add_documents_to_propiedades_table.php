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
            if (!Schema::hasColumn('propiedades', 'certificado_energetico_pdf')) {
                $table->string('certificado_energetico_pdf')->nullable()->after('etiqueta_energetica');
            }
            if (!Schema::hasColumn('propiedades', 'otros_documentos')) {
                $table->json('otros_documentos')->nullable()->after('certificado_energetico_pdf');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('propiedades', function (Blueprint $table) {
            $table->dropColumn(['certificado_energetico_pdf', 'otros_documentos']);
        });
    }
};
