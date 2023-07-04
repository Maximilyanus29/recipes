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
        Schema::create('recipe', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->integer('portion')->nullable();
            $table->integer('ccal')->nullable();
            $table->smallInteger('protein')->nullable();
            $table->smallInteger('fat')->nullable();
            $table->smallInteger('carbohydrates')->nullable();
            $table->string('cooking_time')->nullable();
            $table->text('instruction')->nullable();
            $table->string('link_to_origin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
