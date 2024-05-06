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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->integer('package_id')->default(0);
            $table->string('code');
            $table->integer('discount_type');
            $table->integer('discount_value');
            $table->integer('valid_from');
            $table->integer('valid_to');
            $table->integer('coupon_usage_limit');
            $table->integer('user_usage_limit');
            $table->integer('created_by_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
