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
        Schema::create('sap_responses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sap_controller_id');
            $table->longText('response');
            $table->integer('sap_status');
            $table->integer('response_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sap_responses');
    }
};
