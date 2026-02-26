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
        Schema::create('lab_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lab_id')->constrained('users')->onDelete('cascade'); // ID dari Lab Medik yang menginput
            $table->string('name');
            $table->string('nik')->nullable();
            $table->integer('age');
            $table->string('gender');
            $table->text('address')->nullable();
            $table->string('test_type');
            $table->string('result')->nullable(); // Boleh kosong dulu jika menunggu hasil
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_patients');
    }
};
