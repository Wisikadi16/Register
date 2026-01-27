<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('emergency_calls', function (Blueprint $table) {
        // Menambah kolom ambulance_id (boleh kosong/nullable)
        $table->foreignId('ambulance_id')->nullable()->constrained('ambulances')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('emergency_calls', function (Blueprint $table) {
        $table->dropForeign(['ambulance_id']);
        $table->dropColumn('ambulance_id');
    });
}
};
