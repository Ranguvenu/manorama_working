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
        Schema::create('sms_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('message_id');
            $table->string('channel');
            $table->longText('message');
            $table->string('to_phone')->nullable();
            $table->bigInteger('template_id');
            $table->bigInteger('notification_type_id');
            $table->bigInteger('to_user_id');
            $table->string('module')->nullable();
            $table->bigInteger('created_by_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sms_notifications');
    }
};
