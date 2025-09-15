<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCodigoToPreTriagemTable extends Migration
{
    public function up()
    {
        Schema::table('pre_triagem', function (Blueprint $table) {
            $table->string('codigo')->unique()->after('prioridade');
        });
    }

    public function down()
    {
        Schema::table('pre_triagem', function (Blueprint $table) {
            $table->dropColumn('codigo');
        });
    }
}
