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
        // 1. Tabel Pesan (Komunikasi Operator <-> Driver)
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
            $table->string('subject');
            $table->text('body');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        // 2. Tabel Laporan Sterilisasi Ambulan
        Schema::create('ambulance_sterilizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ambulance_id')->constrained('ambulances')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Driver yg lapor
            $table->date('date');
            $table->string('method'); // Contoh: UV Light, Disinfektan Semprot
            $table->text('notes')->nullable();
            $table->string('photo_proof')->nullable();
            $table->timestamps();
        });
    }

};
