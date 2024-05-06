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
            $table->boolean('callback')->default(0)->after('response');
            $table->integer('callback_on')->default(0)->after('callback');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lead_user_responses', function (Blueprint $table) {
            $table->dropColumn('callback');
            $table->dropColumn('callback_on');
        });
    }
};
