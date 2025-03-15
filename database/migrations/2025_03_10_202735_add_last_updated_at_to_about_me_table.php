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
    Schema::table('about_mes', function (Blueprint $table) {
        $table->date('last_updated_at')->nullable();
    });
    }

public function down(): void
    {
    Schema::table('about_mes', function (Blueprint $table) {
        $table->dropColumn('last_updated_at');
    });
    }
    };
