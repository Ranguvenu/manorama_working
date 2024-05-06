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
        Schema::table('packages', function (Blueprint $table) {
            $table->dropForeign('packages_package_type_id_foreign');
            $table->dropForeign('packages_payment_type_id_foreign');
            $table->dropColumn('validity_type_id');
            $table->dropColumn('package_type_id');
            $table->dropColumn('payment_type_id');
            $table->dropColumn('validity_type_value');
            $table->dropForeign('packages_category_id_foreign');
            $table->dropColumn('category_id');
            $table->unsignedBigInteger('goal_id')->after('id');
            $table->foreign('goal_id')->references('id')->on('hierarchies')->onDelete('cascade');
            $table->boolean('is_paid')->default(1)->after('is_trial_available');
            $table->integer('package_type')->nullable()->after('is_paid');
            $table->integer('trial_duration')->default(0);
            $table->string('validity_type')->nullable()->after('package_type');
            $table->integer('valid_for')->default(0)->after('validity_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropForeign('hierarchies_goal_id_foreign');
        });
    }
};
