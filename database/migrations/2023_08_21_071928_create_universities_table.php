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
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            
            $table->string('name');
            $table->string('code');
            $table->integer('established_on');
            $table->text('address')->nullable();
            $table->string('pincode');
            $table->string('location');
            $table->string('state');
            $table->string('country');
            $table->string('phone');
            $table->string('email');
            $table->string('fax');
            $table->string('website');
            $table->integer('logo_id');
            $table->longText('description');
            $table->boolean('is_published')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('universities');
    }
};
