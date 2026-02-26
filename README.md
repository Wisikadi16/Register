# Ambulan Hebat - Sistem Manajemen Terpadu

Aplikasi **Ambulan Hebat** adalah platform sistem informasi komprehensif yang dirancang untuk mengelola panggilan darurat (SOS), manajemen armada ambulan, rekam medis pasien kedaruratan, manajemen logistik, serta pelaporan kinerja secara presisi. Sistem ini menghubungkan berbagai lapisan jabatan mulai dari Masyarakat, Operator, Tim Lapangan (Driver & Nakes), Faskes (Rumah Sakit, Klinik, Puskesmas, Lab Medik), hingga Super Admin.

---

## 🛠 Tata Cara Penggunaan (Instalasi & Setup)

Berikut adalah langkah-langkah untuk menginstal dan menjalankan aplikasi ini pada server lokal atau _development_:

1. **Persyaratan Sistem:**

   - PHP >= 8.2
   - Composer
   - Node.js & NPM
   - Database MySQL / MariaDB (Direkomendasikan via Laragon/XAMPP)
2. **Instalasi Dependensi:**
   Buka terminal di direktori proyek dan jalankan:

   ```bash
   composer install
   npm install
   ```
3. **Konfigurasi Environment:**
   Duplikat file `.env.example` lalu ubah namanya menjadi `.env`. Sesuaikan konfigurasi databasenya:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database_anda
   DB_USERNAME=root
   DB_PASSWORD=
   ```

   Lalu _generate_ _app key_:

   ```bash
   php artisan key:generate
   ```
4. **Migrasi Database & Seeding (Penting!):**
   Ini akan mereset database dan mengisinya dengan akun dummy beserta peran (_role_) yang lengkap:

   ```bash
   php artisan migrate:fresh --seed
   ```
5. **Menjalankan Aplikasi:**
   Jalankan server PHP dan sistem _build frontend_ Vite secara bersamaan:

   ```bash
   php artisan serve
   npm run dev
   ```

   Aplikasi dapat diakses di `http://localhost:8000` (Atau bisa langsung lewat domain `.test` jika menggunakan Laragon).

### Daftar Akun Testing (Berdasarkan Seeder)

Gunakan email berikut untuk masuk sesuai dengan _job desk_ / _role_ masing-masing. Password asali untuk semua akun adalah: **`password`**

- **Super Admin (IT):** `it@admin.com`
- **Operator 112:** `operator@ah.com`
- **Admin Dinkes:** `admin@dinkes.com`
- **Koordinator (KA):** `ka@dinkes.com`
- **Driver Ambulan:** `driver@ah.com`
- **Nakes (Dokter/Perawat):** `nakes@ah.com`
- **Lab Medik:** `labmedik@ah.com`
- **Rumah Sakit:** `rumahsakit@ah.com`
- **Masyarakat:** `warga@gmail.com`

---

## ⚙️ Cara Maintenance & Pemeliharaan

Agar server berjalan dengan baik secara berkelanjutan, ini adalah hal-hal yang perlu rutin dipantau atau dilakukan:

1. **Pembersihan Cache Berkala:**
   Jika ada _update_ tampilan UI (`.blade.php`), konfigurasi, atau rute kode yang tidak kunjung berubah di browser, jalankan ini di terminal:

   ```bash
   php artisan optimize:clear
   php artisan view:clear
   php artisan config:clear
   ```
2. **Update Struktur Database:**
   Jika perlu menambah tabel baru, **jangan** edit file migrasi lama yang sudah masuk ke server _production_. Gunakan:

   ```bash
   php artisan make:migration create_tabel_baru_table
   ```

   Atau jika hanya _development_ lokal, boleh edit file lama lalu jalankan `php artisan migrate:fresh --seed`.
3. **Backup Database:**
   Lakukan pencadangan (Eksport `.sql`) secara berkala, minimal mingguan, untuk berjaga-jaga hilangnya data rekam pasien atau data panggilan SOS operasional. Diharapkan membuat fitur/otomasi cron job di kemudian hari untuk mecadangkan database ke AWS S3/Google Drive.
4. **Kemanan Sistem:**
   Pastikan folder `vendor` dan `node_modules` selalu masuk di dalam `.gitignore`. Hanya unggah baris kode utama dan gunakan perintah `composer install` & `npm ci` di _production_. Gunakan sertifikat SSL (HTTPS) jika aplikasi diterbitkan untuk ranah publik.

---

## 🚀 Rencana Pengembangan & Fitur yang Belum Selesai (Backlog)

Berikut adalah beberapa modul serta spesifikasi dari _flowchart_ yang masih dalam proses persiapan dan **membutuhkan pengerjaan selanjutnya**:

### 1. Eksekusi Modul Rumah Sakit (Target Selanjutnya)

Sesuai Activity Diagram Rumah Sakit, fitur ini belum ditungkan menjadi kode sepenuhnya:

- [ ] Memecah _routing_ khusus grup **Rumah Sakit** (memisahkan dari Faskes/Puskesmas).
- [ ] Implementasi `SpvRs` (Menu Data SPV RS).
- [ ] Implementasi _reuse_ tabel `Ambulance` di `RumahSakitController`.
- [ ] Implementasi form `FeedbackKll` (Evaluasi Kecelakaan Lalu Lintas) lengkap beserta model dan migrasinya.

### 2. Live Tracking & WebSocket Time-Real (Penting)

Sistem Notifikasi Merah di Kanan Bawah dan GPS saat ini masih bersifat semi-instan (_refresh/polling AJAX_ biasa).

- [ ] Menerapkan **Laravel Reverb** atau **Pusher / Soketi**.
- [ ] Tracking titik kordinat Driver yang sedang bergerak dan ditampilkan mulus secara asinkronus ke layar Dashboard Operator.

### 3. Modul Broadcast & Push Notifications

- [X] Menanamkan konektivitas _WhatsApp Gateway_ (Fonnte/Wablas). Saat warga memencet SOS, notifikasi akan langsung terdorong sebagai pesan WA ke nomor Driver agar _Response Time_ mereka makin sigap.
- [ ] Push Notifications di Mobile App/PWA menggunakan _Firebase Cloud Messaging_ (FCM).

### 4. Ekspor Laporan Lengkap (Reporting)

- [ ] Pembuatan fitur Eksport Cetak Dokumen ke `.pdf` (pakai _DomPDF / Browsershot_) dan ke `.xlsx` (pakai _Laravel Excel / PhpSpreadsheet_) di Dashboard Dinas Kesehatan (Admin) dan Koordinator (KA). Ini di perlukan untuk pelaporan triwulan ke pimpinan wali kota/gub.

### 5. API Mobile Base

- [ ] Pembangunan sistem endpoint `routes/api.php` berbasis Laravel Sanctum yang solid apabila tim Nakes & Driver nantinya dibekali Aplikasi Android berbasis React Native / Flutter, untuk fitur _scan barcode_ alat steril, _tracking_ GPS nativ, dan isi Rekam Medis langsung tanpa lewat Browser _Web View_.
