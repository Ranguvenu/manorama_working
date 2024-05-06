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
        Schema::create('coupon_code_claims', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('coupon_code_id');
            $table->bigInteger('order_id');
            $table->integer('coupon_amount');
            $table->bigInteger('used_by_id');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupon_code_claims');
    }
};
