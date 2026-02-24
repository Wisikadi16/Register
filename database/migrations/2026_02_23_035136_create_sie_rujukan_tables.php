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
        // 1. PKP Puskesmas
        Schema::create('sie_pkp_puskesmas', function (Blueprint $table) {
            $table->id();
            $table->string('puskesmas_id');
            $table->string('periode');
            $table->integer('nilai');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });

        // 2. SPV Puskesmas
        Schema::create('sie_spv_puskesmas', function (Blueprint $table) {
            $table->id();
            $table->string('puskesmas_id');
            $table->string('aspek');
            $table->text('temuan')->nullable();
            $table->text('rekomendasi')->nullable();
            $table->timestamps();
        });

        // 3. SPV RS
        Schema::create('sie_spv_rs', function (Blueprint $table) {
            $table->id();
            $table->string('rs_id');
            $table->string('jenis');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });

        // 4. SPV Lab
        Schema::create('sie_spv_lab', function (Blueprint $table) {
            $table->id();
            $table->string('lab_id');
            $table->string('target');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });

        // 5. SPV Klinik
        Schema::create('sie_spv_klinik', function (Blueprint $table) {
            $table->id();
            $table->string('klinik_id');
            $table->string('kategori');
            $table->text('inspeksi')->nullable();
            $table->timestamps();
        });

        // 6. Validasi Jadwal
        Schema::create('sie_validasi_jadwals', function (Blueprint $table) {
            $table->id();
            $table->string('modul');
            $table->string('bulan_tahun');
            $table->text('catatan')->nullable();
            $table->string('sah')->default('tidak');
            $table->timestamps();
        });

        // 7. Validasi LPLPO
        Schema::create('sie_validasi_lplpos', function (Blueprint $table) {
            $table->id();
            $table->string('instansi_id');
            $table->string('bulan');
            $table->string('status_stok');
            $table->text('evaluasi')->nullable();
            $table->string('sah')->default('tidak');
            $table->timestamps();
        });

        // 8. Validasi AH
        Schema::create('sie_validasi_ahs', function (Blueprint $table) {
            $table->id();
            $table->string('tiket');
            $table->string('triage');
            $table->text('evaluasi')->nullable();
            $table->string('valid')->default('tidak');
            $table->timestamps();
        });

        // 9. Stratifikasi RS
        Schema::create('sie_stratifikasi_rs', function (Blueprint $table) {
            $table->id();
            $table->string('rs_id');
            $table->string('tipe_lama')->default('Tipe C');
            $table->string('tipe_baru');
            $table->text('analisis')->nullable();
            $table->timestamps();
        });

        // 10. Laporan BHD
        Schema::create('sie_laporan_bhds', function (Blueprint $table) {
            $table->id();
            $table->string('periode');
            $table->string('lokasi');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sie_laporan_bhds');
        Schema::dropIfExists('sie_stratifikasi_rs');
        Schema::dropIfExists('sie_validasi_ahs');
        Schema::dropIfExists('sie_validasi_lplpos');
        Schema::dropIfExists('sie_validasi_jadwals');
        Schema::dropIfExists('sie_spv_klinik');
        Schema::dropIfExists('sie_spv_lab');
        Schema::dropIfExists('sie_spv_rs');
        Schema::dropIfExists('sie_spv_puskesmas');
        Schema::dropIfExists('sie_pkp_puskesmas');
    }
};
