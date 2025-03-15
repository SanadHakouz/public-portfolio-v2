<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_mes', function (Blueprint $table) {
            $table->string('resume_file')->nullable()->after('bio');
            // If you had a 'resume_link' column and want to remove it, uncomment this:
            // $table->dropColumn('resume_link');
        });
    }

    public function down(): void
    {
        Schema::table('about_mes', function (Blueprint $table) {
            $table->dropColumn('resume_file');
            // If you're removing 'resume_link', add this to the down method:
            // $table->string('resume_link')->nullable()->after('bio');
        });
    }
};
