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
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->text('nombre');
            $table->text('apellidos');
            $table->text('cedula');
            $table->unsignedBigInteger('fk_area')->nullable()->index('fk_area_instructor');
            $table->mediumText('tipo');
            $table->text('vinculacion');
            $table->integer('horassemana');
            $table->mediumText('email');
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
        Schema::dropIfExists('instructors');
    }
};
