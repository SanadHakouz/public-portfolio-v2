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
        $table->text('user_agent')->change();
    });
}

public function down()
{
    Schema::table('page_visits', function (Blueprint $table) {
        $table->string('user_agent')->change();
    });
}
};
