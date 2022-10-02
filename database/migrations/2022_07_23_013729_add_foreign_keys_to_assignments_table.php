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
        Schema::table('assignments', function (Blueprint $table) {
          $table->foreign(['fk_ficha'], 'fk_assignment_card')->references(['id'])->on('cards');
          $table->foreign(['fk_competencia'], 'fk_assignment_competence')->references(['id'])->on('competences');
          $table->foreign(['fk_resultado'], 'fk_assignment_outcome')->references(['id'])->on('learning_outcomes');
          $table->foreign(['fk_instructor'], 'fk_assignment_instructor')->references(['id'])->on('instructors');
          $table->foreign(['fk_ambiente'], 'fk_assignment_environment')->references(['id'])->on('environments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assignments', function (Blueprint $table) {
            $table->dropForeign('fk_assignment_card');
            $table->dropForeign('fk_assignment_competence');
            $table->dropForeign('fk_assignment_outcome');
            $table->dropForeign('fk_assignment_instructor');
            $table->dropForeign('fk_assignment_environment');
        });
    }
};
