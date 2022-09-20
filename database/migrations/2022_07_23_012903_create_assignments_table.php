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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_ficha')->nullable()->index('fk_assignment_card');
            $table->unsignedBigInteger('fk_competencia')->nullable()->index('fk_assignment_competence');
            $table->unsignedBigInteger('fk_resultado')->nullable()->index('fk_assignment_outcome');
            $table->unsignedBigInteger('fk_instructor')->nullable()->index('fk_assignment_instructor');
            $table->unsignedBigInteger('fk_ambiente')->nullable()->index('fk_assignment_environment');
            $table->unsignedBigInteger('fk_tipo')->nullable()->index('fk_assignment_type');
            $table->longText('descripcion');
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
        Schema::dropIfExists('assignments');
    }
};
