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
        Schema::table('cards', function (Blueprint $table) {
          $table->foreign(['fk_programa'], 'fk_ficha_programa')->references(['id'])->on('programs');
          $table->foreign(['fk_instructor'], 'fk_ficha_instructor')->references(['id'])->on('instructors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->dropForeign('fk_ficha_programa');
            $table->dropForeign('fk_ficha_instructor');
        });
    }
};
