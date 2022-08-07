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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->text('codigo');
            $table->mediumText('nombre');
            $table->integer('duracionlectiva');
            $table->integer('duracionpractica');
            $table->mediumText('nivelformacion');
            $table->longText('perfilinstructor');
            $table->integer('totaltrimestres');
            $table->longText('descripcion');
            $table->boolean('isEliminated')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programs');
    }
};
