<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('store_user', function (Blueprint $table) {
            $table->foreignId('store_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('role')->default('employee');
            $table->timestamps();

            $table->primary(['store_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('store_user');
    }
};
