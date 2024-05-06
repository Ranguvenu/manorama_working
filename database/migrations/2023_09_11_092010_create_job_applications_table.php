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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('job_posting_id');
            $table->longText('resume');
            $table->integer('status')->nullable();
            $table->string('qualification');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('job_posting_id')->references('id')->on('job_postings')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_applications', function ($table) {
            $table->dropForeign('job_applications_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('job_applications_job_posting_id_foreign');
            $table->dropColumn('job_posting_id');
        });
        Schema::dropIfExists('job_applications');
    }
};
