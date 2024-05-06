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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('hierarchies')->onDelete('cascade');
            $table->unsignedBigInteger('board_id');
            $table->foreign('board_id')->references('id')->on('hierarchies')->onDelete('cascade');
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('hierarchies')->onDelete('cascade');
            $table->integer('validity_type_id');
            $table->string('validity_type_value');
            $table->string('thumbnail_id');
            $table->string('title');
            $table->string('code')->unique();
            $table->longText('description')->nullable();
            $table->timestamp('valid_from');
            $table->timestamp('valid_to');
            $table->unsignedBigInteger('package_type_id');
            $table->foreign('package_type_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('payment_type_id');
            $table->foreign('payment_type_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('is_trial_available')->default(0);
            $table->integer('is_published')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
