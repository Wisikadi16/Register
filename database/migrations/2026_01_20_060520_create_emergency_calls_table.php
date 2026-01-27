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
        Schema::create('emergency_calls', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke User (Pelapor)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Data Kejadian
            $table->string('location');     // Lokasi
            $table->text('description');    // Keterangan
            
            // Status (Penting! Ini yang bikin error tadi)
            $table->string('status')->default('pending'); // pending, process, done, cancelled
            
            // Koordinat Peta
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            
            $table->timestamps();
            
            // Catatan: Kolom 'ambulance_id' tidak ditulis di sini 
            // karena akan ditambahkan otomatis oleh migration tanggal 26 (Januari) yang sudah Anda buat.
            // Jadi urutannya aman.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergency_calls');
    }
};