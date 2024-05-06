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
        Schema::table('lead_user_responses', function (Blueprint $table) {
            $table->integer('captured_from')->default(0)->after('status');
            $table->string('call_id')->nullable()->after('captured_from');
            $table->longText('response')->nullable()->change();
            $table->string('status')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lead_user_responses', function (Blueprint $table) {
            $table->dropColumn('captured_from');
            $table->dropColumn('call_id');
        });
    }
};
