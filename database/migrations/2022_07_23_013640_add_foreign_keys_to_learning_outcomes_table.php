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
        Schema::table('learning_outcomes', function (Blueprint $table) {
          $table->foreign(['fk_competencia'], 'fk_competencia_resultado')->references(['id'])->on('competences');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('learning_outcomes', function (Blueprint $table) {
            $table->dropForeign('fk_competencia_resultado');
        });
    }
};
