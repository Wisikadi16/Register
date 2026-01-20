<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmergencyCall extends Model
{
    use HasFactory;

    // Pastikan sesuai dengan tabel migration
    protected $fllable = [
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
