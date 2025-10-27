<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('salas', function (Blueprint $table) {
            $table->integer('capacidade')->default(5)->after('nome'); // valor padrão 5 pacientes por sala
        });
    }

    public function down(): void
    {
        Schema::table('salas', function (Blueprint $table) {
            $table->dropColumn('capacidade');
        });
    }
};
