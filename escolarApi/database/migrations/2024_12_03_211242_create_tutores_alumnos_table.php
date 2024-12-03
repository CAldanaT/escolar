<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tutores_alumnos', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->bigInteger('alumno_id');
            $table->bigInteger('tutor_id');

            $table->primary('id');
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete("cascade");
            $table->foreign('tutor_id')->references('id')->on('tutores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutores_alumnos');
    }
};
