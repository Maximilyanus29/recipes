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
            $table->text('description');
            $table->smallInteger('portion');
            $table->smallInteger('ccal');
            $table->smallInteger('protein');
            $table->smallInteger('fat');
            $table->smallInteger('carbohydrates');
            $table->smallInteger('cooking_time');
            $table->text('instruction');
            $table->string('link_to_origin');
            $table->text('sovet');
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
