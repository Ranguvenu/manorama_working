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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('category_id');
            $table->string('subject');
            $table->longText('tags')->nullable();
            $table->date('publish_from');
            $table->longText('description')->nullable();
            $table->boolean('open')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->string('slug');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_postings', function ($table) {
            $table->dropForeign('job_postings_created_by_foreign');
            $table->dropColumn('created_by');
            $table->dropForeign('job_postings_updated_by_foreign');
            $table->dropColumn('updated_by');
            $table->dropForeign('job_postings_category_id_foreign');
            $table->dropColumn('category_id');
        });
        Schema::dropIfExists('job_postings');
    }
};
