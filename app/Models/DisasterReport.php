<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisasterReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'location',
        'latitude',
        'longitude',
        'casualties_light',
        'casualties_heavy',
        'casualties_deceased',
        'casualties_missing',
        'damage_desc',
        'photo_proof',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
