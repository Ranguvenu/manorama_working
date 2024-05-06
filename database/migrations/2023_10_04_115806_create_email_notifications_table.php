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
        Schema::create('email_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('channel');
            $table->string('to_email');
            $table->longText('subject');
            $table->longText('message');
            $table->string('module');
            $table->bigInteger('notification_type_id');
            $table->bigInteger('template_id');
            $table->bigInteger('to_user_id');
            $table->bigInteger('created_by_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_notifications');
    }
};
