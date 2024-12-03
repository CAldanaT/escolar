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
        Schema::create('escuelas', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->string('name', 255);
            $table->bigInteger('comunidad_id');

             $table->primary('id');
             $table->foreign('comunidad_id')->references('id')->on('comunidades');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escuelas');
    }
};
