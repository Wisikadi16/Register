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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emergency_call_id')->constrained()->onDelete('cascade');
            $table->string('tensi')->nullable();
            $table->integer('nadi')->nullable();
            $table->decimal('suhu', 4, 1)->nullable();
            $table->integer('nafas')->nullable();
            $table->text('keluhan_utama')->nullable();
            $table->text('tindakan')->nullable();
            $table->string('foto_kejadian')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
