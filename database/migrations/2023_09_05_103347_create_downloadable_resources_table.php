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
        Schema::create('downloadable_resources', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('publish_from');
            $table->string('publish_to');
            $table->unsignedBigInteger('resource_type_id')->nullable();
            $table->integer('resource_id');
            $table->string('is_active')->default(0);
            $table->foreign('resource_type_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('downloadable_resources');
    }
};
