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
        Schema::table('package_pricings', function (Blueprint $table) {
            $table->float('actual_price')->change();
            $table->float('selling_price')->change();
            $table->float('sap_ism_amount')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('package_pricings', function (Blueprint $table) {
            //
        });
    }
};
