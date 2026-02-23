<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Hospital;

class Referral extends Model
{
    protected $fillable = [
        'patient_name',
        'nik',
        'origin_hospital_id',
        'destination_hospital_id',
        'diagnosis',
        'status',
        'feedback_note',
    ];

    public function originHospital()
    {
        return $this->belongsTo(Hospital::class, 'origin_hospital_id');
    }

    public function destinationHospital()
    {
        return $this->belongsTo(Hospital::class, 'destination_hospital_id');
    }
}
