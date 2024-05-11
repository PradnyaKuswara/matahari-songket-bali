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
        Schema::create('visitor_metas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('visitor_id')->constrained('visitors')->cascadeOnDelete();
            $table->integer('identity');
            $table->text('link')->nullable();
            $table->text('slug')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_metas');
    }
};
