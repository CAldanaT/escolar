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
        Schema::create('materias', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->bigInteger('grupo_id');
            $table->bigInteger('materia_id');

            $table->primary('id');
            $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete("cascade");
            $table->foreign('materia_id')->references('id')->on('catalog');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materias');
    }
};
