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
        Schema::table('ingredient', function (Blueprint $table) {
            $table->boolean('contain_lactose')->nullable();
            $table->boolean('can_be_replaced_with_lactose_free')->nullable();
            $table->boolean('contain_gluten')->nullable();
            $table->boolean('contain_sugar')->nullable();
            $table->boolean('healthy_eating')->nullable();
            $table->boolean('fat')->nullable();
            $table->boolean('fry')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ingredient', function (Blueprint $table) {
            $table->dropColumn('contain_lactose');
            $table->dropColumn('can_be_replaced_with_lactose_free');
            $table->dropColumn('contain_gluten');
            $table->dropColumn('contain_sugar');
            $table->dropColumn('healthy_eating');
            $table->dropColumn('fat');
            $table->dropColumn('fry');
        });
    }
};
