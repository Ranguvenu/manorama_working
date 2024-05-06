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
        Schema::create('hierarchies', function (Blueprint $table) {
            $table->id();
            $table->integer('type_id');
            $table->string('title');
            $table->string('code')->unique();
            $table->longText('description')->nullable();
            $table->longText('image')->nullable();
            $table->integer('parent_id');
            $table->integer('depth');
            $table->string('path')->nullable();
            $table->integer('mdl_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hierarchies');
    }
};
