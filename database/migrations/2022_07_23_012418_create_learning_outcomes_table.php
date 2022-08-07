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
        Schema::create('learning_outcomes', function (Blueprint $table) {
            $table->id();
            $table->longText('descripcion');
            $table->integer('trimestreasignacion');
            $table->integer('trimestreevaluacion');
            $table->integer('horassemana');
            $table->unsignedBigInteger('fk_competencia')->nullable()->index('fk_competencia_resultado');
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
        Schema::dropIfExists('learning_outcomes');
    }
};
