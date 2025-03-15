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
        Schema::table('projects', function (Blueprint $table) {
            // Add the new documentation_url column
            $table->string('documentation_url')->nullable()->after('github_link');

            // Optional: Drop the old documentation_path column if it exists
            // Uncomment if needed:
            // if (Schema::hasColumn('projects', 'documentation_path')) {
            //     $table->dropColumn('documentation_path');
            // }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Reverse the changes
            $table->dropColumn('documentation_url');

            // Optional: Add back the old column if you removed it
            // Uncomment if needed:
            // $table->string('documentation_path')->nullable()->after('github_link');
        });
    }
};
