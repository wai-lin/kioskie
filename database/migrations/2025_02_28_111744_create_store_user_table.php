<?php

use App\Enums\StoreRole;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('store_user', function (Blueprint $table) {
            $table->foreignId('store_id');
            $table->foreignId('user_id');
            $table->enum('role', StoreRole::values())->default(StoreRole::EMPLOYEE->value);
            $table->timestamps();

            $table->primary(['store_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('store_user');
    }
};
