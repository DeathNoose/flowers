<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained('flowers')->onDelete('cascade');
            $table->enum('type', ['category_based', 'popular', 'frequently_bought']);
            $table->boolean('is_clicked')->default(false);
            $table->timestamp('clicked_at')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'is_clicked']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_recommendations');
    }
};