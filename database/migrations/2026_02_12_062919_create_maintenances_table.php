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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ambulance_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('inventory_id')->nullable()->constrained()->onDelete('cascade');
            $table->enum('type', ['service_rutin', 'kerusakan', 'kalibrasi']);
            $table->text('description');
            $table->date('scheduled_date');
            $table->enum('status', ['scheduled', 'completed', 'overdue'])->default('scheduled');
            $table->decimal('cost', 15, 2)->default(0);
            $table->string('proof_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
