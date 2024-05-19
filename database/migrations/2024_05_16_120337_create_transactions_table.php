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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid();

            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();

            $table->string('generate_id')->unique()->nullable();
            $table->string('type')->nullable();
            $table->double('item_total_price');
            $table->double('shipping_price');
            $table->double('tax');
            $table->double('total_price');
            $table->double('money')->nullable();
            $table->string('snap_token')->nullable();
            $table->enum('status', ['pending', 'settlement', 'failed', 'refund', 'expired', 'cancel', 'deny', 'capture'])->default('pending');
            $table->timestamp('expired_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
