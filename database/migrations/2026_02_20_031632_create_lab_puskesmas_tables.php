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
    // Tabel Data Supervisor Puskesmas
        Schema::create('puskesmas_supervisors', function (Blueprint $table) {
            $table->id();
            // User login (Puskesmas) yang menginput data ini
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('nip')->nullable();
            $table->string('jabatan');
            $table->string('phone')->nullable();
            $table->timestamps();
        });

    // Tabel Laporan BHD (Bantuan Hidup Dasar)
            Schema::create('bhd_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal_kegiatan');
            $table->string('lokasi');
            $table->integer('jumlah_peserta');
            $table->text('keterangan')->nullable();
            $table->string('foto_kegiatan')->nullable(); // Path foto upload
            $table->timestamps();
        });
    }

};
