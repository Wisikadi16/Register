<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverAlert extends Model
{
    use HasFactory;

    protected $fillable = [
        'ambulance_id',
        'driver_id',
        'latitude',
        'longitude',
        'status', // 'open', 'resolved'
    ];

    public function ambulance()
    {
        return $this->belongsTo(Ambulance::class);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
