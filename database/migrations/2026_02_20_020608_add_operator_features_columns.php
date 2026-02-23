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
        // 1. Tambah Kolom No HP di Users (Untuk fitur Kontak Driver)
        if (!Schema::hasColumn('users', 'phone_number')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('phone_number', 20)->nullable()->after('email');
            });
        }

        // 2. Tambah Tipe Ambulan (Untuk fitur Ambulan Swasta/Masyarakat)
        if (!Schema::hasColumn('ambulances', 'type')) {
            Schema::table('ambulances', function (Blueprint $table) {
                $table->enum('type', ['dinas', 'swasta', 'masyarakat'])->default('dinas')->after('name');
                $table->string('owner_contact', 20)->nullable()->after('type'); // Kontak pemilik/driver swasta
            });
        }

        // 3. Buat Tabel Jadwal Driver (Untuk fitur Input Data Jadwal)
        Schema::create('driver_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Driver
            $table->date('date');
            $table->enum('shift', ['pagi', 'siang', 'malam']); // Pagi: 07-14, Siang: 14-21, Malam: 21-07
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_schedules');

        if (Schema::hasColumn('ambulances', 'type')) {
            Schema::table('ambulances', function (Blueprint $table) {
                $table->dropColumn(['type', 'owner_contact']);
            });
        }

        if (Schema::hasColumn('users', 'phone_number')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('phone_number');
            });
        }
    }
};
