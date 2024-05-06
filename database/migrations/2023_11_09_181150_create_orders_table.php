<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_key')->nullable();
            $table->string('reference_key')->nullable();
            $table->string('transaction_id')->nullable();
            $table->bigInteger('user_id')->default(0);
            $table->integer('order_amount')->default(0);
            $table->integer('discount_amount')->default(0);
            $table->integer('net_payable')->default(0);
            $table->integer('status')->default(0);
            $table->integer('created_by_id')->default(0);
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
