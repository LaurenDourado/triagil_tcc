<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pre_triagem', function (Blueprint $table) {
            if (!Schema::hasColumn('pre_triagem', 'uso_medicacao')) {
                $table->string('uso_medicacao')->nullable();
            }

            if (!Schema::hasColumn('pre_triagem', 'qual_medicacao')) {
                $table->string('qual_medicacao')->nullable();
            }

            if (!Schema::hasColumn('pre_triagem', 'alergias')) {
                $table->string('alergias')->nullable();
            }

            if (!Schema::hasColumn('pre_triagem', 'sintomas')) {
                $table->json('sintomas')->nullable();
            }

            if (!Schema::hasColumn('pre_triagem', 'sintomas_outro')) {
                $table->string('sintomas_outro')->nullable();
            }

            if (!Schema::hasColumn('pre_triagem', 'tempo_sintomas')) {
                $table->string('tempo_sintomas')->nullable();
            }

            if (!Schema::hasColumn('pre_triagem', 'intensidade')) {
                $table->string('intensidade')->nullable();
            }

            if (!Schema::hasColumn('pre_triagem', 'atendimento_medico')) {
                $table->string('atendimento_medico')->nullable();
            }

            if (!Schema::hasColumn('pre_triagem', 'emergencia')) {
                $table->string('emergencia')->nullable();
            }

            if (!Schema::hasColumn('pre_triagem', 'prioridade')) {
                $table->string('prioridade')->nullable();
            }

            if (!Schema::hasColumn('pre_triagem', 'codigo')) {
                $table->string('codigo')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('pre_triagem', function (Blueprint $table) {
            $columns = [
                'uso_medicacao', 'qual_medicacao', 'alergias', 'sintomas',
                'sintomas_outro', 'tempo_sintomas', 'intensidade',
                'atendimento_medico', 'emergencia', 'prioridade', 'codigo'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('pre_triagem', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
