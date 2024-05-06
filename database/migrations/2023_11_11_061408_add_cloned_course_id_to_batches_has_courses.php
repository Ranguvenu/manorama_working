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
        Schema::table('batches_has_courses', function (Blueprint $table) {
            $table->bigInteger('cloned_course_id')->default(0)->after('course_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('batches_has_courses', function (Blueprint $table) {
            $table->dropColumn('cloned_course_id');
        });
    }
};
