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
        Schema::create('interested_in', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id');
            $table->integer('product_id')->default(0);
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('source_id');
            $table->longText('tags')->nullable();
            $table->string('received_from')->nullable();
            $table->integer('status')->default(0);
            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('source_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('created_by_id');
            $table->unsignedBigInteger('updated_by_id');
            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('interested_in', function ($table) {
            $table->dropForeign('interested_in_lead_id_foreign');
            $table->dropColumn('lead_id');
            $table->dropForeign('interested_in_category_id_foreign');
            $table->dropColumn('category_id');
        });
        Schema::dropIfExists('interested_in');
    }
};
