<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('order_number')->unique();
            $table->string('customer_name');
            $table->string('phone');
            
            // Адрес доставки (разбитый на поля)
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('house')->nullable();
            $table->string('entrance')->nullable();
            $table->string('door_code')->nullable();
            $table->string('floor')->nullable();
            $table->string('apartment')->nullable();
            $table->string('address_comment')->nullable();
            $table->text('address')->nullable(); // полный адрес для обратной совместимости
            
            // Время доставки
            $table->date('delivery_date')->nullable();
            $table->string('delivery_time')->nullable();  

            
            // Комментарий к заказу
            $table->text('comment')->nullable();
            
            // Финансы
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2);
            
            // Статусы
            $table->string('status')->default('new');
            $table->string('payment_status')->nullable();
            $table->string('payment_id')->nullable();
            $table->foreignId('promocode_id')->nullable()->constrained()->nullOnDelete();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};