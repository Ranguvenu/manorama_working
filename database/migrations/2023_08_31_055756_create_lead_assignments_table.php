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
        Schema::create('lead_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('interested_in_id');
            $table->unsignedBigInteger('assigned_to_id');
            $table->unsignedBigInteger('assigned_by_id');
            $table->foreign('assigned_to_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assigned_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('interested_in_id')->references('id')->on('interested_in')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lead_assignments', function ($table) {
            $table->dropForeign('lead_assignments_interested_in_id_foreign');
            $table->dropColumn('interested_in_id');
            $table->dropForeign('lead_assignments_assigned_to_id_foreign');
            $table->dropColumn('assigned_to_id');
            $table->dropForeign('lead_assignments_assigned_by_id_foreign');
            $table->dropColumn('assigned_by_id');
        });
        Schema::dropIfExists('lead_assignments');
    }
};
