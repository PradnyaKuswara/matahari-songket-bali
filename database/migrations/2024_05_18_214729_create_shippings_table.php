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
            $table->uuid()->unique();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');

            $table->string('name');
            $table->string('courier_code')->nullable();
            $table->string('courier')->nullable();
            $table->string('tracking_number')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('subdistrict')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('additional_information')->nullable();
            $table->string('phone_number')->nullable();
            $table->enum('status', ['pending', 'cancel', 'packing', 'shipping', 'delivered'])->default('pending');
            $table->dateTime('shipped_at')->nullable();
            $table->dateTime('delivered_at')->nullable();
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
