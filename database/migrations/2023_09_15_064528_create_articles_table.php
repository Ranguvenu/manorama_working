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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->longText('title');
            $table->longText('description');
            $table->integer('image_id')->default(0);
            $table->string('category');
            $table->integer('video_id')->default(0);
            $table->integer('thumbnail_id')->default(0);
            $table->longText('short_description')->nullable();
            $table->boolean('is_published')->default(0);
            $table->integer('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->integer('blog_type_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('order')->default(0);
            $table->integer('published_on');
            $table->text('labels');
            $table->longtext('tags');
            $table->integer('created_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('updated_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
