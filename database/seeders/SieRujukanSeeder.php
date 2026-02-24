<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\SiePkpPuskesmas;
use App\Models\SieSpvPuskesmas;
use App\Models\SieSpvRs;
use App\Models\SieSpvLab;
use App\Models\SieSpvKlinik;
use App\Models\SieValidasiJadwal;
use App\Models\SieValidasiLplpo;
use App\Models\SieValidasiAh;
use App\Models\SieStratifikasiRs;
use App\Models\SieLaporanBhd;

class SieRujukanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. PKP Puskesmas
        SiePkpPuskesmas::create([
            'puskesmas_id' => 'Puskesmas Pandanaran',
            'periode' => '2025-10',
            'nilai' => 92,
            'catatan' => 'Kinerja pelayanan medis dasar sangat baik dan tercatat sesuai target.',
            'created_at' => Carbon::now()->subDays(2)
        ]);

        SiePkpPuskesmas::create([
            'puskesmas_id' => 'Puskesmas Halmahera',
            'periode' => '2025-09',
            'nilai' => 78,
            'catatan' => 'Perlu peningkatan di area administrasi rekam medis.',
            'created_at' => Carbon::now()->subDays(15)
        ]);

        // 2. SPV Puskesmas
        SieSpvPuskesmas::create([
            'puskesmas_id' => 'Puskesmas Srondol',
            'aspek' => 'Fasilitas & SDM',
            'temuan' => 'Ketersediaan APD ruang IGD menipis.',
            'rekomendasi' => 'Segera ajukan pengadaan barang ke Dinas.',
            'created_at' => Carbon::now()->subDays(3)
        ]);

        // 3. SPV RS
        SieSpvRs::create([
            'rs_id' => 'RS Panti Wilasa',
            'jenis' => 'Audit Ketersediaan Bed',
            'catatan' => 'Kapasitas bed rawat inap ICU penuh sejak kemarin.',
            'created_at' => Carbon::now()->subDays(1)
        ]);

        SieSpvRs::create([
            'rs_id' => 'RSUD Wongsonegoro',
            'jenis' => 'Kesiapan Fasilitas Rujukan',
            'catatan' => 'Sistem rujukan SPGDT terintegrasi sempurna.',
            'created_at' => Carbon::now()->subDays(7)
        ]);

        // 4. SPV Lab
        SieSpvLab::create([
            'lab_id' => 'Lab Kesehatan Daerah (Labkesda)',
            'target' => 'Kelayakan & Kalibrasi Alat Cek',
            'catatan' => 'Semua alat sentrifugasi telah dikalibrasi sesuai standar SNI.',
            'created_at' => Carbon::now()->subDays(4)
        ]);

        // 5. SPV Klinik
        SieSpvKlinik::create([
            'klinik_id' => 'Klinik Utama Kasih Ibu',
            'kategori' => 'Perpanjangan Izin',
            'inspeksi' => 'Fasilitas sterilisasi memadai, izin layak diperpanjang 5 tahun.',
            'created_at' => Carbon::now()->subDays(10)
        ]);

        // 6. Validasi Jadwal
        SieValidasiJadwal::create([
            'modul' => 'Shift Operator (112 Command Center)',
            'bulan_tahun' => '2026-03',
            'catatan' => 'Formasi jaga malam telah disetujui tanpa perubahan.',
            'sah' => 'Ya',
            'created_at' => Carbon::now()->subDays(1)
        ]);

        SieValidasiJadwal::create([
            'modul' => 'Shift Jaga IGD / Faskes Mitra',
            'bulan_tahun' => '2026-04',
            'catatan' => 'Terdapat kekurangan tenaga medis untuk cuti bersama minggu depan.',
            'sah' => 'Tidak',
            'created_at' => Carbon::now()->subHours(5)
        ]);

        // 7. Validasi LPLPO
        SieValidasiLplpo::create([
            'instansi_id' => 'Puskesmas Halmahera',
            'bulan' => '2026-02',
            'status_stok' => 'Warning (Sisa 1-2 Bulan)',
            'evaluasi' => 'Stok Paracetamol menipis, disetujui penambahan 50 box.',
            'sah' => 'Ya',
            'created_at' => Carbon::now()->subDays(2)
        ]);

        SieValidasiLplpo::create([
            'instansi_id' => 'Puskesmas Pandanaran',
            'bulan' => '2026-02',
            'status_stok' => 'Kritis (Kosong / Hampir Habis)',
            'evaluasi' => 'Menunggu review Apoteker utama Dinas.',
            'sah' => 'Tidak',
            'created_at' => Carbon::now()->subHours(10)
        ]);

        // 8. Validasi AH
        SieValidasiAh::create([
            'tiket' => 'AH-2602-00512',
            'triage' => 'Sesuai SOP',
            'evaluasi' => 'Respon cepat di bawah 10 menit, penanganan sesuai ACLS.',
            'valid' => 'Ya',
            'created_at' => Carbon::now()->subDays(1)
        ]);

        SieValidasiAh::create([
            'tiket' => 'AH-2602-00889',
            'triage' => 'Kurang Tepat (Butuh Evaluasi Tim Medis)',
            'evaluasi' => 'Pasien dilarikan ke faskes terjauh, mohon koordinasi driver ambulans.',
            'valid' => 'Tidak',
            'created_at' => Carbon::now()->subHours(2)
        ]);

        // 9. Stratifikasi RS
        SieStratifikasiRs::create([
            'rs_id' => 'RS Telogorejo',
            'tipe_lama' => 'Tipe C',
            'tipe_baru' => 'Tipe B',
            'analisis' => 'Jumlah dokter subspesialis memenuhi kualifikasi RS kelas B.',
            'created_at' => Carbon::now()->subDays(20)
        ]);

        // 10. Laporan BHD
        SieLaporanBhd::create([
            'periode' => 'Kuartal 4 (Okt-Des) 2025',
            'lokasi' => 'Balai Kota Semarang',
            'keterangan' => 'Sertifikat telah dicetak bagi 150 peserta BHD awam.',
            'created_at' => Carbon::now()->subDays(40)
        ]);
    }
}
