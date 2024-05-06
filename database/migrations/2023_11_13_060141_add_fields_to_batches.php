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
        Schema::table('batches', function (Blueprint $table) {
            $table->timestamp('enrollment_start_date')->after('batch_start_date');
            $table->timestamp('enrollment_end_date')->after('enrollment_start_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('batches', function (Blueprint $table) {
            $table->dropColumn('enrollment_start_date');
            $table->dropColumn('enrollment_end_date');
        });
    }
};
