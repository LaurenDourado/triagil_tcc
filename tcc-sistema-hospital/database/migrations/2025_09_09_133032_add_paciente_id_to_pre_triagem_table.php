<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPacienteIdToPreTriagemTable extends Migration
{
    public function up()
    {
        Schema::table('pre_triagem', function (Blueprint $table) {
            $table->unsignedBigInteger('paciente_id')->nullable()->after('id');
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('pre_triagem', function (Blueprint $table) {
            $table->dropForeign(['paciente_id']);
            $table->dropColumn('paciente_id');
        });
    }
}
