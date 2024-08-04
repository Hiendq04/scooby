<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('voucher_id')->nullable();
            $table->string('order_number')->unique();
            $table->string('email')->nullable();
            $table->decimal('original_amount', 8, 2)->comment('Giá tiền tổng các sản phẩm');
            $table->decimal('discounted_amount', 8, 2)->comment('Số tiền được giảm');
            $table->decimal('total_amount', 8, 2)->comment('Số tiền phải trả');
            $table->string('shipping_address');
            $table->string('phone');
            $table->string('note')->nullable();
            $table->enum('payment_method', ['payments','cod', 'paypak'])->default('cod');
            $table->boolean('is_paid')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('order_statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
