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
        Schema::create('tutores', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->string('name', 255);
            $table->string('curp', 20)->nullable();
            $table->string('telefono')->nullable();
            $table->bigInteger('parentesco_id');

            $table->primary('id');
            $table->foreign('parentesco_id')->references('id')->on('catalog');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutores');
    }
};
