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
        Schema::create('package_pricing_has_courses', function (Blueprint $table) {
            $table->id();
            $table->integer('package_pricing_id');
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('hierarchies')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_pricing_has_courses');
    }
};
