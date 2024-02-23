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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('product_code', 5)->unique();
            $table->foreign('product_code')
                ->references('product_code')
                ->on('products')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('rule_id')
                ->references('id')
                ->on('rules')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
