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
            $table->id();
            $table->integer('periodo');
            $table->string('gurpo', 2);
            $table->unsignedBigInteger('grado_id');
            $table->unsignedBigInteger('escuela_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            
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
