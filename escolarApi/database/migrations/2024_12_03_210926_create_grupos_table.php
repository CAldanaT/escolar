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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};
