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
        Schema::create('pase_lista', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->tinyInteger('asistencia')->default(0);
            $table->string('comentario', 255);
            $table->unsignedBigInteger('grupo_id');
            $table->unsignedBigInteger('alumno_id');
            $table->timestamps();

            $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete("cascade");
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pase_lista');
    }
};
