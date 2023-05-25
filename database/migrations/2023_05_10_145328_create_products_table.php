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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->unique();
            $table->integer('category_id')->nullable();
            $table->string('name', 191)->nullable()->charset('utf8mb4')->collation('utf8mb4_vietnamese_ci');
            $table->string('slug', 191)->nullable();
            $table->text('small_description')->nullable()->charset('utf8mb4')->collation('utf8mb4_vietnamese_ci');
            $table->text('description')->nullable()->charset('utf8mb4')->collation('utf8mb4_vietnamese_ci');
            $table->decimal('original_price', 20, 2)->nullable();
            $table->decimal('selling_price', 20, 2)->nullable();
            $table->string('image', 191)->nullable()->charset('utf8mb4')->collation('utf8mb4_vietnamese_ci');
            $table->integer('qty')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('trending')->nullable();
            $table->string('meta_title', 191)->nullable()->charset('utf8mb4')->collation('utf8mb4_vietnamese_ci');
            $table->text('meta_description')->nullable()->charset('utf8mb4')->collation('utf8mb4_vietnamese_ci');
            $table->text('meta_keywords')->nullable()->charset('utf8mb4')->collation('utf8mb4_vietnamese_ci');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
