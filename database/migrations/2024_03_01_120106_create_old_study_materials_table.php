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
        Schema::create('old_study_materials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slugp');
            $table->longText('body');
            $table->longText('short_description')->nullable();
            $table->boolean('enable_comments')->tinyint();
            $table->string('tags');
            $table->longText('og_tag')->nullable();
            $table->longText('schema_markup')->nullable();
            $table->longText('title_tag')->nullable();
            $table->longText('meta_description')->nullable();
            $table->boolean('published')->tinyint();
            $table->boolean('is_featured')->tinyint();
            $table->boolean('is_active')->tinyint();
            $table->string('image')->nullable();
            $table->string('image_thumbnail')->nullable();
            $table->longText('video_url')->nullable();
            $table->dateTime('published_on')->nullable();
            $table->dateTime('created_on');
            $table->dateTime('updated_on');
            $table->integer('board_id');
            $table->integer('chapter_id');
            $table->integer('class_level_id');
            $table->integer('created_by_id')->nullable();
            $table->integer('goal_id');
            $table->integer('owner_id')->nullable();
            $table->integer('subject_id');
            $table->integer('topic_id');
            $table->integer('unit_id');
            $table->integer('updated_by_id')->nullable();
            $table->longText('about_name')->nullable();
            $table->longText('assesses')->nullable();
            $table->longText('educational_level')->nullable();
            $table->longText('quiz_description')->nullable();
            $table->longText('quiz_qn_ids')->nullable();
            $table->string('quiz_title')->nullable();
            $table->longText('schema_info')->nullable();
            $table->longText('schema_json')->nullable();
            $table->longText('schema_name')->nullable();
            $table->longText('schema_qn_ids')->nullable();
            $table->longText('typical_age_range')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('old_study_materials');
    }
};
