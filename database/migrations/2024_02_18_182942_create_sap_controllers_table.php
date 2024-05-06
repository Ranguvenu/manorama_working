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
        Schema::create('sap_controllers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id');
            $table->longText('payload');
            $table->integer('sap_type');
            $table->boolean('is_submitted')->default(0);
            $table->bigInteger('last_submited_at');
            $table->integer('status')->default(0);
            $table->integer('attempts')->default(0);
            $table->boolean('is_edited')->default(0);
            $table->bigInteger('updated_by_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sap_controllers');
    }
};
