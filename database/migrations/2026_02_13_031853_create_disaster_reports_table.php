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
        Schema::create('disaster_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pelapor (Nakes/Driver)
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->integer('casualties_light')->default(0); // Korban Luka Ringan
            $table->integer('casualties_heavy')->default(0); // Korban Luka Berat
            $table->integer('casualties_deceased')->default(0); // Korban Meninggal
            $table->integer('casualties_missing')->default(0); // Korban Hilang
            $table->text('damage_desc')->nullable(); // Deskripsi Kerusakan
            $table->string('photo_proof')->nullable(); // Foto Bukti
            $table->enum('status', ['verifying', 'verified', 'rejected'])->default('verifying');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disaster_reports');
    }
};
