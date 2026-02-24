<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('facility_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID Puskesmas/Faskes
            $table->string('category'); // logistik, maintenance, dll
            $table->text('description');
            $table->string('photo_proof')->nullable();
            $table->enum('status', ['pending', 'process', 'completed', 'rejected'])->default('pending');
            $table->text('operator_notes')->nullable(); // Balasan dari operator
            $table->foreignId('operator_id')->nullable()->constrained('users')->onDelete('set null'); // ID Operator
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('facility_requests');
    }
};