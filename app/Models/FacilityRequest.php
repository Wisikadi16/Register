<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category',
        'description',
        'photo_proof',
        'status',
        'operator_notes',
        'operator_id'
    ];

    // Relasi ke tabel users (Siapa Faskes yang lapor)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke tabel users (Siapa Operator yang ngerespon)
    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }
}