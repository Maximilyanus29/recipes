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
        Schema::create('recipes_to_category', function (Blueprint $table) {
            $table->id();
            $table->integer('recipe_id');
            $table->integer('category_id');
            $table->foreign('recipe_id')->references('id')->on('recipe');
            $table->foreign('category_id')->references('id')->on('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes_to_category');
    }
};
