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
        Schema::create('page_components', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_id');
            $table->unsignedBigInteger('page_component_type_id');
            $table->integer('order')->default(0);
            $table->boolean('visible')->default(1);
            $table->longtext('configuration')->nullable();
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->foreign('page_component_type_id')->references('id')->on('page_component_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('page_components', function($table){
            $table->dropForeign('page_components_page_id_foreign');
            $table->dropColumn('page_id');
            $table->dropForeign('page_components_page_component_type_id_foreign');
            $table->dropColumn('page_component_type_id');
        });
        Schema::dropIfExists('page_components');
    }
};
