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
        Schema::create('old_articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('label');
            $table->string('slug');
            $table->longText('body');
            $table->longText('tags');
            $table->string('banner_img')->nullable();
            $table->string('banner_video')->nullable();
            $table->string('banner_img_thumb')->nullable();
            $table->longText('short_description')->nullable();
            $table->string('order')->nullable();
            $table->boolean('is_active')->tinyint();
            $table->boolean('is_published')->tinyint();
            $table->dateTime('published_on')->nullable();
            $table->boolean('is_featured')->tinyint();
            $table->boolean('is_student_editor')->tinyint();
            $table->longText('embed_url')->nullable();
            $table->dateTime('created_on');
            $table->dateTime('updated_on');
            $table->integer('created_by_id')->nullable();
            $table->integer('owner_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->longText('meta_desc')->nullable();
            $table->string('title_tags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('old_articles');
    }
};
