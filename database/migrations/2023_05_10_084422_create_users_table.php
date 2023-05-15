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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191)->nullable()->charset('utf8mb4')->collation('utf8mb4_vietnamese_ci');
            $table->string('email', 191)->unique();
            $table->string('phone', 30)->unique();
            $table->string('address', 191)->nullable()->charset('utf8mb4')->collation('utf8mb4_vietnamese_ci');
            $table->string('password', 191)->nullable();
            $table->tinyInteger('role_as')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
