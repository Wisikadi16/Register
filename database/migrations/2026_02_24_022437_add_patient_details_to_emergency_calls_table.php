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
            $table->string('patient_name')->nullable()->after('caller_phone');
            $table->integer('patient_age')->nullable()->after('patient_name');
            $table->text('patient_condition')->nullable()->after('patient_age');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('emergency_calls', function (Blueprint $table) {
            $table->dropColumn(['patient_name', 'patient_age', 'patient_condition']);
        });
    }
};
