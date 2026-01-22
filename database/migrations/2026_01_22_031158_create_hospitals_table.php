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
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // RSUP Dr. Kariadi
            $table->string('phone_igd')->nullable();
            $table->string('address')->nullable();
        
            // Lokasi RS (Agar Driver tau jaraknya)
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
        
            // Data Ketersediaan (Diupdate oleh User RS)
            $table->integer('available_bed_igd')->default(0);
            $table->integer('available_bed_icu')->default(0);
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospitals');
    }
};
