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
        Schema::table('pages', function (Blueprint $table) {
            $table->longText('seo_configuration')->nullable()->after('configuration');
            $table->bigInteger('package_id')->after('seo_configuration')->default(0);
            $table->dropColumn('meta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('package_id');
            $table->dropColumn('seo_configuration');
        });
    }
};
