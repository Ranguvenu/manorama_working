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
        Schema::table('study_materials', function (Blueprint $table) {
            $table->timestamp('published_on')->after('author_id')->nullable();
            $table->string('slug')->after('published_on')->nullable();
            $table->dropColumn('publish_on');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('study_materials', function (Blueprint $table) {
            $table->dropColumn('published_on');
            $table->dropColumn('slug');
        });
    }
};
