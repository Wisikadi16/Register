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
        'type', // Panggilan ambulan atau telepon
        'caller_name',
        'caller_phone',
        'patient_name',
        'patient_age',
        'patient_condition',
        'ambulance_id', // <--- Wajib ada biar driver bisa update tugas
        'hospital_id',  // <--- Tambahkan Baris INI
        'location',
        'description',
        'photo',        // <--- Tambahkan Baris INI (Foto Bukti)
        'status',
        'latitude',     // <--- Wajib untuk peta
        'longitude',    // <--- Wajib untuk peta
        'driver_name',
        'nakes_name'
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

    // Tambahan: Relasi ke Rumah Sakit Tujuan
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}