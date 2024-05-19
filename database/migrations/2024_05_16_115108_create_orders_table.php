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
            $table->id();
            $table->uuid();

            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('address_id')->constrained('addresses')->cascadeOnDelete();

            $table->string('generate_id')->unique()->nullable();
            $table->double('item_total_price');
            $table->double('shipping_price');
            $table->double('tax');
            $table->integer('quantity')->default(0);
            $table->double('total_price');
            $table->boolean('status')->default(false);

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
