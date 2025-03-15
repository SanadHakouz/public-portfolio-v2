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
        Schema::create('technologies', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('title');
            $table->string('icon')->nullable(); // Icon class or path
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->json('items')->nullable(); // For storing technology items like HTML, CSS, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technologies');
    }
};
