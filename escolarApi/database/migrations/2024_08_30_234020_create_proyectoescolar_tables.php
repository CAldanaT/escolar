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
        Schema::create('catalog', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->string('name', 255);
            $table->integer('block');
            $table->integer('item');
        });

        Schema::create('comunidades', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->string('name', 255);

             $table->primary('id');
        });

        Schema::create('escuelas', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->string('name', 255);
            $table->bigInteger('comunidad_id');

             $table->primary('id');
             $table->foreign('comunidad_id')->references('id')->on('comunidades');
        });

        Schema::create('maestros', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->string('name', 255);
            $table->string('telefono')->nullable();
            $table->bigInteger('escuela_id');

            $table->primary('id');
            $table->foreign('escuela_id')->references('id')->on('escuelas');
        });

        Schema::create('grupos', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->integer('trimestre');
            $table->integer('periodo');
            $table->string('gurpo', 2);
            $table->bigInteger('grado_id');
            $table->bigInteger('escuela_id');
            $table->bigInteger('maestro_id');
            

            $table->primary('id');
            $table->foreign('grado_id')->references('id')->on('catalog');
            $table->foreign('escuela_id')->references('id')->on('escuelas');
            $table->foreign('maestro_id')->references('id')->on('maestros');
        });

        Schema::create('materias', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->bigInteger('grupo_id');
            $table->bigInteger('materia_id');

            $table->primary('id');
            $table->foreign('grupo_id')->references('id')->on('grupos');
            $table->foreign('materia_id')->references('id')->on('catalog');
        });

        Schema::create('tutores', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->string('name', 255);
            $table->string('curp', 20)->nullable();
            $table->string('telefono')->nullable();
            $table->bigInteger('parentesco_id');

            $table->primary('id');
            $table->foreign('parentesco_id')->references('id')->on('catalog');
        });

        Schema::create('alumnos', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->string('name', 255);
            $table->string('curp', 20)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->bigInteger('grupo_id');

            $table->primary('id');
            $table->foreign('grupo_id')->references('id')->on('grupos');
        });

        Schema::create('tutores_alumnos', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->bigInteger('alumno_id');
            $table->bigInteger('tutor_id');

            $table->primary('id');
            $table->foreign('alumno_id')->references('id')->on('alumnos');
            $table->foreign('tutor_id')->references('id')->on('tutores');
        });

        Schema::create('pase_lista', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->date('fecha');
            $table->tinyInteger('asistencia')->default(0);
            $table->string('comentario', 255);
            $table->bigInteger('grupo_id');
            $table->bigInteger('alumno_id');

            $table->primary('id');
            $table->foreign('grupo_id')->references('id')->on('grupos');
            $table->foreign('alumno_id')->references('id')->on('alumnos');
        });

        Schema::create('proyectos_academicos', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->bigInteger('grupo_id');
            $table->bigInteger('materia_id');
            $table->integer('total_tareas_proyectos');
            $table->string('name');

            $table->primary('id');
            $table->foreign('grupo_id')->references('id')->on('grupos');
            $table->foreign('materia_id')->references('id')->on('materias');
        });

        Schema::create('tareas_pa_alumnos', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->bigInteger('proyecto_academico_id');
            $table->bigInteger('alumno_id');

            $table->primary('id');
            $table->foreign('proyecto_academico_id')->references('id')->on('proyectos_academicos');
            $table->foreign('alumno_id')->references('id')->on('alumnos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog');
        Schema::dropIfExists('comunidades');
        Schema::dropIfExists('escuelas');
        Schema::dropIfExists('grupos');
        Schema::dropIfExists('maestros');
        Schema::dropIfExists('materias');
        Schema::dropIfExists('tutores');
        Schema::dropIfExists('alumnos');
        Schema::dropIfExists('tutores_alumnos');
        Schema::dropIfExists('pase_lista');
        Schema::dropIfExists('proyectos_academicos');
        Schema::dropIfExists('tareas_pa_alumnos');
    }
};
