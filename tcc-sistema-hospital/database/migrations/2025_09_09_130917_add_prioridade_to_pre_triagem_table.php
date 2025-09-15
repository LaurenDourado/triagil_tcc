<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('pre_triagem', function (Blueprint $table) {
        $table->string('prioridade')->nullable()->after('emergencia');
    });
}

public function down(): void
{
    Schema::table('pre_triagem', function (Blueprint $table) {
        $table->dropColumn('prioridade');
    });
}
};
