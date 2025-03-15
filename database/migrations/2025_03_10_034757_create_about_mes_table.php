<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_mes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('profile_image')->nullable();
            $table->string('job_title');
            $table->text('bio');
            $table->string('resume_file')->nullable();
            $table->json('certificates')->nullable();
            $table->json('ongoing_courses')->nullable();
            $table->json('completed_courses')->nullable();
            $table->json('languages')->nullable();
            $table->date('last_updated_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_mes');
    }
};
