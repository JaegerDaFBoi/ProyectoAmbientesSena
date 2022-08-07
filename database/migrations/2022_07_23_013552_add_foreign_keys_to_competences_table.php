<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('competences', function (Blueprint $table) {
          $table->foreign(['fk_programa'], 'fk_programa_competencia')->references(['id'])->on('programs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('competences', function (Blueprint $table) {
            $table->dropForeign('fk_programa_competencia');
        });
    }
};
