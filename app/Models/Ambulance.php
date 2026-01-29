<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
    // Tambahkan baris ini agar bisa di-seed
    protected $guarded = [];

    // Relasi ke Basecamp (Puskesmas)
    public function basecamp()
    {
        return $this->belongsTo(Basecamp::class);
    }

    // Relasi ke Driver (User)
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}