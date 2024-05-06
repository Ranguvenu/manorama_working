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
        Schema::table('sap_responses', function (Blueprint $table) {
            $table->longText('payload')->nullable()->after('sap_controller_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sap_responses', function (Blueprint $table) {
            $table->dropColumn('payload');
        });
    }
};
