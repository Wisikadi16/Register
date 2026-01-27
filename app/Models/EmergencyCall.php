<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyCall extends Model
{
    use HasFactory;

    // Pastikan field ini bisa diisi (Mass Assignment)
    protected $fillable = [
        'user_id',
        'location',
        'description',
        'status',
    ];

    // Relasi: Setiap panggilan dimiliki oleh satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}