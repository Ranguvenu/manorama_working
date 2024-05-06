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
        Schema::create('study_materials', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('goal_id')->default(0);
            $table->BigInteger('board_id')->default(0);
            $table->BigInteger('class_id')->default(0);
            $table->BigInteger('subject_id')->default(0);
            $table->integer('chapter_id')->default(0);
            $table->integer('thumbnail_id')->default(0);
            $table->text('title');
            $table->longText('description');
            $table->boolean('publish_on');
            $table->integer('status');
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->longText('seo_configuration')->nullable();
            $table->unsignedBigInteger('created_by_id');
            $table->unsignedBigInteger('updated_by_id');
            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_materials');
    }
};
