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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('country_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->longText('address')->nullable();
            $table->integer('country')->default(0);
            $table->integer('state')->default(0);
            $table->string('city')->default(0);
            $table->integer('dob')->default(0);
            $table->integer('user_type_id')->default(0);
            $table->integer('profile_id')->nullable();
            $table->integer('mdl_user')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
