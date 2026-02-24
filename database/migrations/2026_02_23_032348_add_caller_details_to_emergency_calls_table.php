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
        Schema::table('emergency_calls', function (Blueprint $table) {
            $table->string('caller_name')->nullable()->after('user_id');
            $table->string('caller_phone')->nullable()->after('caller_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('emergency_calls', function (Blueprint $table) {
            $table->dropColumn(['caller_name', 'caller_phone']);
        });
    }
};
