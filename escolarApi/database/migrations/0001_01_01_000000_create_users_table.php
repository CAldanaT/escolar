<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    

    #endRegion
    /**
     * Run the migrations.
     */
    public function up(): void
    {
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

        Schema::create('users', function (Blueprint $table) {
            $table->bigInteger("id")->autoIncrement();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('admin')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->string('telefono')->nullable();
            $table->bigInteger('escuela_id');

            $table->primary('id');
            $table->foreign('escuela_id')->references('id')->on('escuelas');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->bigInteger('user_id');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();

            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->bigInteger("id")->autoIncrement();
            $table->string('name', 50);
        });

          Schema::create('user_roles', function (Blueprint $table) {
            $table->bigInteger("user_id");
            $table->bigInteger('role_id');

            $table->primary(['user_id','role_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");
            $table->foreign('role_id')->references('id')->on('roles')->onDelete("cascade");
        });


        Schema::create('catalog', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->string('name', 255);
            $table->integer('block');
            $table->integer('item');
        });

        Schema::create('grupos', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->integer('periodo');
            $table->string('gurpo', 2);
            $table->bigInteger('grado_id');
            $table->bigInteger('escuela_id');
            $table->bigInteger('user_id');
            
            $table->primary('id');
            $table->foreign('grado_id')->references('id')->on('catalog');
            $table->foreign('escuela_id')->references('id')->on('escuelas')->onDelete("cascade");
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('materias', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->bigInteger('grupo_id');
            $table->bigInteger('materia_id');

            $table->primary('id');
            $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete("cascade");
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

            $table->primary('id');
        });

        Schema::create('alumnos_grupos', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->bigInteger('grupo_id');
            $table->bigInteger('alumno_id');

            $table->primary('id');
            $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete("cascade");
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete("cascade");
        });

        Schema::create('tutores_alumnos', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->bigInteger('alumno_id');
            $table->bigInteger('tutor_id');

            $table->primary('id');
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete("cascade");
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
            $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete("cascade");
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete("cascade");
        });

        Schema::create('proyectos_academicos', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->bigInteger('grupo_id');
            $table->bigInteger('materia_id');
            $table->integer('total_tareas_proyectos');
            $table->string('name');
            $table->integer('order');
            $table->integer('trimestre');

            $table->primary('id');
            $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete("cascade");
            $table->foreign('materia_id')->references('id')->on('materias');
        });

        Schema::create('tareas_pa_alumnos', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->bigInteger('proyecto_academico_id');
            $table->bigInteger('alumno_id');
            $table->integer('order');

            $table->primary('id');
            $table->foreign('proyecto_academico_id')->references('id')->on('proyectos_academicos')->onDelete("cascade");
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Scheme::dropIfExists('roles');
        Scheme::dropIfExists('user_roles');

        Schema::dropIfExists('catalog');
        Schema::dropIfExists('comunidades');
        Schema::dropIfExists('escuelas');
        Schema::dropIfExists('grupos');
        Schema::dropIfExists('materias');
        Schema::dropIfExists('tutores');
        Schema::dropIfExists('alumnos');
        Schema::dropIfExists('tutores_alumnos');
        Schema::dropIfExists('pase_lista');
        Schema::dropIfExists('proyectos_academicos');
        Schema::dropIfExists('tareas_pa_alumnos');
        Schema::dropIfExists('alumnos_grupos');
    }
};
