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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();

            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $table->string('address')->nullable();
            $table->string('idCity')->nullable();
            $table->string('city')->nullable();
            $table->string('idProvince')->nullable();
            $table->string('province')->nullable();
            $table->string('idSubdistrict')->nullable();
            $table->string('subdistrict')->nullable();
            $table->string('country')->default('Indonesia')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('additional_information')->nullable();
            $table->string('phone_number')->nullable();

            $table->boolean('is_active')->default(false);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
