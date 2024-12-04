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
        Schema::create('tareas_pa_alumnos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyecto_academico_id');
            $table->unsignedBigInteger('alumno_id');
            $table->integer('order');
            $table->timestamps();

            $table->foreign('proyecto_academico_id')->references('id')->on('proyectos_academicos')->onDelete("cascade");
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas_pa_alumnos');
    }
};
