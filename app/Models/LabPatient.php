<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LabPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'lab_id',
        'name',
        'nik',
        'age',
        'gender',
        'address',
        'test_type',
        'result',
    ];

    public function lab()
    {
        return $this->belongsTo(User::class, 'lab_id');
    }
}
