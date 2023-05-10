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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tracking_no', 191)->nullable();
            $table->integer('user_id')->nullable();
            $table->string('name', 191)->nullable()->charset('utf8mb4')->collation('utf8mb4_vietnamese_ci');
            $table->string('email', 191)->nullable();
            $table->string('phone', 30)->nullable();
            $table->text('address')->nullable()->charset('utf8mb4')->collation('utf8mb4_vietnamese_ci');
            $table->integer('pin_code')->nullable();
            $table->decimal('total_price', 20, 2)->nullable();
            $table->tinyInteger('payment_mode')->nullable();
            $table->string('payment_id', 191)->nullable();
            $table->tinyInteger('ship_mode')->nullable();
            $table->string('ship_id', 191)->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('comments', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
