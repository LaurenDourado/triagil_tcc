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
        Schema::table('pacientes', function (Blueprint $table) {
            // Adiciona a coluna sala_id como nullable e cria a chave estrangeira
            $table->foreignId('sala_id')->nullable()->constrained('salas')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pacientes', function (Blueprint $table) {
            // Remove a chave estrangeira antes de remover a coluna
            $table->dropForeign(['sala_id']);
            $table->dropColumn('sala_id');
        });
    }
};
