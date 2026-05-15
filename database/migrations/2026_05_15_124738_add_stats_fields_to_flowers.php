<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('flowers', function (Blueprint $table) {
            $table->decimal('avg_rating', 3, 2)->default(0);
            $table->integer('reviews_count')->default(0);
            $table->integer('total_sold')->default(0);
            $table->integer('views_count')->default(0);
        });
    }

    public function down()
    {
        Schema::table('flowers', function (Blueprint $table) {
            $table->dropColumn(['avg_rating', 'reviews_count', 'total_sold', 'views_count']);
        });
    }
};