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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $table->string('invoice');
            $table->string('order_date');
            $table->string('sub_total');
            $table->string('total');
            $table->string('status')->default('p')->comment('p = padding, c = confirm, p = process, s = shipping, d = delivered, c = cancel');
            $table->string('ip_address');
            $table->string('shipping_cost');
            $table->string('discount');
            $table->string('payment_type');
            $table->string('billing_phone');
            $table->string('billing_email');
            $table->string('billing_address');
            $table->string('shipping_phone');
            $table->string('shipping_email');
            $table->string('shipping_address');
            $table->timestamps();
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
