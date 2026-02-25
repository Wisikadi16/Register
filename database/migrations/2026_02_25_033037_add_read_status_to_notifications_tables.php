<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('facility_requests', function (Blueprint $table) {
            $table->boolean('is_read_by_user')->default(false)->after('operator_id');
            $table->boolean('is_read_by_operator')->default(false)->after('is_read_by_user');
        });

        Schema::table('emergency_calls', function (Blueprint $table) {
            $table->boolean('is_read_by_operator')->default(false)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facility_requests', function (Blueprint $table) {
            $table->dropColumn(['is_read_by_user', 'is_read_by_operator']);
        });

        Schema::table('emergency_calls', function (Blueprint $table) {
            $table->dropColumn('is_read_by_operator');
        });
    }
};
