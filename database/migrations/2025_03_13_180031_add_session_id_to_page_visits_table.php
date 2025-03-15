<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('page_visits', function (Blueprint $table) {
            // Add session_id column if it doesn't exist
            if (!Schema::hasColumn('page_visits', 'session_id')) {
                $table->string('session_id')->nullable()->after('referrer');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('page_visits', function (Blueprint $table) {
            if (Schema::hasColumn('page_visits', 'session_id')) {
                $table->dropColumn('session_id');
            }
        });
    }
};