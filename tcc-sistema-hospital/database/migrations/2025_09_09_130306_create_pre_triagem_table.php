<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pre_triagem', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            $table->json('doencas')->nullable();
            $table->string('uso_medicacao')->nullable();
            $table->string('qual_medicacao')->nullable();
            $table->string('alergias')->nullable();
            $table->json('sintomas')->nullable();
            $table->string('sintomas_outro')->nullable();
            $table->string('tempo_sintomas')->nullable();
            $table->string('intensidade')->nullable();
            $table->string('atendimento_medico')->nullable();
            $table->string('emergencia')->nullable();
            $table->string('prioridade')->nullable();
            $table->string('codigo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pre_triagem');
    }
};
