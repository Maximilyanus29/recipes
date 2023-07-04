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
        Schema::create('recipes_to_ingredient', function (Blueprint $table) {
            $table->id();
            $table->integer('recipe_id');
            $table->integer('ingredient_id');
            $table->string('value');
            $table->foreign('recipe_id')->references('id')->on('recipe');
            $table->foreign('ingredient_id')->references('id')->on('ingredient');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes_to_ingredient');
    }
};
