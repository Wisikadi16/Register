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
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->string('nik', 16)->nullable();
            $table->foreignId('origin_hospital_id')->constrained('hospitals')->onDelete('cascade');
            $table->foreignId('destination_hospital_id')->constrained('hospitals')->onDelete('cascade');
            $table->string('diagnosis');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('feedback_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
