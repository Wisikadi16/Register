<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'emergency_call_id',
        'tensi',
        'nadi',
        'suhu',
        'nafas',
        'keluhan_utama',
        'tindakan',
        'foto_kejadian',
        'keterangan',
    ];

    public function emergencyCall()
    {
        return $this->belongsTo(EmergencyCall::class);
    }
}
