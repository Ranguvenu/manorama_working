<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lead_user_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('interested_in_id');
            $table->unsignedBigInteger('agent_id');
            $table->string('status');
            $table->longText('response');
            $table->foreign('interested_in_id')->references('id')->on('interested_in')->onDelete('cascade');
            $table->foreign('agent_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_user_responses');
    }
};
