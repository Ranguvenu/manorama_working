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
        Schema::create('lead_registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('registered_by_id');
            $table->timestamp('created_on');
            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('registered_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lead_registrations', function ($table) {
            $table->dropForeign('lead_registrations_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('lead_registrations_lead_id_foreign');
            $table->dropColumn('lead_id');
            $table->dropForeign('lead_registrations_registered_by_id_foreign');
            $table->dropColumn('registered_by_id');
        });
        Schema::dropIfExists('lead_registrations');
    }
};
