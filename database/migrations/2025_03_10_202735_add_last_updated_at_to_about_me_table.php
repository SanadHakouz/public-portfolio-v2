<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Column already exists in the create table migration
        // Intentionally left empty to avoid duplicate column error
    }

    public function down(): void
    {
        // No action needed
    }
};