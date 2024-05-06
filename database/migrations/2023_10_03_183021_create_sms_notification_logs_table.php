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
        Schema::create('sms_notification_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sms_notification_id');
            $table->string('event');
            $table->bigInteger('generated_by_id');
            $table->timestamp('logged_at')->format('Y-m-d\TH:i:s.u\Z');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sms_notification_logs');
    }
};
