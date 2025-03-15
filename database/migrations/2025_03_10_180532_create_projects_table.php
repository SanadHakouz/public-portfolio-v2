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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('github_link')->nullable();
            $table->string('documentation_url')->nullable(); // Removed the after() method
            $table->string('image_path')->nullable();
            $table->json('technologies')->nullable(); // Store technologies as JSON
            $table->boolean('is_completed')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects'); // Changed to dropIfExists for proper reversal
    }
};
