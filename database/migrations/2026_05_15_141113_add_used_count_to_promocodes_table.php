<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('promocodes', function (Blueprint $table) {
            $table->integer('used_count')->default(0)->after('usage_limit');
        });
    }

    public function down()
    {
        Schema::table('promocodes', function (Blueprint $table) {
            $table->dropColumn('used_count');
        });
    }
};