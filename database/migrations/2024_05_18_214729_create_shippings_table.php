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
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->uuid();

            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->string('name');
            $table->string('courier')->nullable();
            $table->string('tracking_number')->nullable();
            $table->string('tracking_link')->nullable();
            $table->enum('status', ['pending', 'shipping', 'delivered'])->default('pending');
            $table->dateTime('shipped_at')->nullable();
            $table->dateTime('max_confirm')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};
