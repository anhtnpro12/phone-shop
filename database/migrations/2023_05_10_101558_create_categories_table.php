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
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191)->nullable()->charset('utf8mb4')->collation('utf8mb4_vietnamese_ci');
            $table->string('slug', 191)->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('popular')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
