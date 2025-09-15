<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        public function up()
    {
        Schema::table('pre_triagem', function (Blueprint $table) {
            $table->string('codigo_unico')->nullable()->unique();
        });
    }

    public function down()
    {
        Schema::table('pre_triagem', function (Blueprint $table) {
            $table->dropColumn('codigo_unico');
        });
    }
    
};
