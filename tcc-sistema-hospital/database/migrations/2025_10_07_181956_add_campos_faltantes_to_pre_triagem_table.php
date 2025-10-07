<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pre_triagem', function (Blueprint $table) {
            if (!Schema::hasColumn('pre_triagem', 'alergias')) {
                $table->string('alergias')->nullable()->after('qual_medicacao');
            }
            if (!Schema::hasColumn('pre_triagem', 'sintomas_outro')) {
                $table->string('sintomas_outro')->nullable()->after('sintomas');
            }
            // Adicione aqui outras colunas faltantes
        });
    }

    public function down(): void
    {
        Schema::table('pre_triagem', function (Blueprint $table) {
            if (Schema::hasColumn('pre_triagem', 'alergias')) {
                $table->dropColumn('alergias');
            }
            if (Schema::hasColumn('pre_triagem', 'sintomas_outro')) {
                $table->dropColumn('sintomas_outro');
            }
        });
    }
};
