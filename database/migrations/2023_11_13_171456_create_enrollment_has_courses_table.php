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
        Schema::create('enrollment_has_courses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('enrollment_id');
            $table->bigInteger('batch_id');
            $table->bigInteger('hierarchy_id')->default(0);
            $table->integer('status')->default(0);
            $table->longText('mdl_response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollment_has_courses');
    }
};
