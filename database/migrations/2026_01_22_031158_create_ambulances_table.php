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
        Schema::create('ambulances', function (Blueprint $table) {
            $table->id();
            $table->string('plat_number')->unique(); // H 1234 KA
            $table->string('name'); // Ambulan 01
        
            // Relasi: Ambulan ini milik Basecamp mana?
            $table->foreignId('basecamp_id')->constrained('basecamps')->onDelete('cascade');
        
            // Status Operasional (Penting untuk DSS)
            // ready = Siap di markas
            // busy = Sedang tugas
            // maintenance = Rusak/Servis
            $table->enum('status', ['ready', 'busy', 'maintenance'])->default('ready');
        
            // Posisi Terkini (Untuk Live Tracking)
            $table->decimal('current_latitude', 10, 8)->nullable();
            $table->decimal('current_longitude', 11, 8)->nullable();
        
            // Relasi ke User Driver (Siapa yang bawa sekarang?)
            $table->foreignId('driver_id')->nullable()->constrained('users')->onDelete('set null');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ambulances');
    }
};
