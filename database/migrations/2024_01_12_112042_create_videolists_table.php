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
        Schema::create('videolists', function (Blueprint $table) {
            $table->id();
            $table->string('title'); 
            $table->unsignedBigInteger('category_id');  
            $table->longText('video');
            $table->longText('thumbnail');
            $table->integer('published_from');
            $table->integer('published_to');
            $table->bigInteger('created_by_id');
            $table->bigInteger('updated_by_id');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videolists');
    }
};
