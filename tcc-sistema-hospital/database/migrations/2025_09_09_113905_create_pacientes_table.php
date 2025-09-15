<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->string('telefone')->after('email');
            $table->integer('idade')->after('telefone');
            $table->enum('genero', ['feminino', 'masculino', 'outro'])->after('idade');
        });
    }

    public function down()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->dropColumn(['telefone', 'idade', 'genero']);
        });
    }
};
