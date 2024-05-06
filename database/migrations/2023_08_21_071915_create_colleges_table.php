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
        Schema::create('colleges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('established_year');
            $table->text('type');
            $table->text('address');
            $table->string('country');
            $table->string('state');
            $table->string('district');
            $table->string('pincode');
            $table->string('contact_person')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('email');
            $table->string('website');
            $table->integer('student_intake')->nullable();
            $table->string('nat_rank')->nullable();
            $table->boolean('is_deemed')->nullable()->tinyint();
            $table->string('name_of_principal')->nullable();
            $table->string('contact_no_of_principal')->nullable();
            $table->string('email_of_principal')->nullable();
            $table->string('admin');
            $table->longtext('short_description')->nullable();
            $table->longtext('why_join')->nullable();
            $table->text('high_light_text')->nullable();
            $table->text('similar_location')->nullable();
            $table->text('similar_college')->nullable();
            $table->integer('logo_id')->nullable()->default(0);
            $table->integer('brochure_id')->nullable()->default(0);
            $table->integer('application_form_id')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colleges');
    }
};
