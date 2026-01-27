<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyCall extends Model
{
    use HasFactory;

    // KITA TAMBAHKAN KOLOM PENTING YANG HILANG
    protected $fillable = [
        'user_id',
        'ambulance_id', // <--- Wajib ada biar driver bisa update tugas
        'location',
        'description',
        'status',
        'latitude',     // <--- Wajib untuk peta
        'longitude'     // <--- Wajib untuk peta
    ];

    // Relasi: Setiap panggilan dimiliki oleh satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Tambahan: Relasi ke Ambulance (Opsional tapi bagus)
    public function ambulance()
    {
        return $this->belongsTo(Ambulance::class);
    }
}