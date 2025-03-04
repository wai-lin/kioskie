<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_store', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained();
            $table->foreignId('store_id')->constrained();
            $table->integer('quantity');
            $table->timestamps();

            $table->primary(['product_id', 'store_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_store');
    }
};
