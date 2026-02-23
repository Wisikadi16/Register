<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ambulance;
use App\Models\Inventory;

class Maintenance extends Model
{
    protected $fillable = [
        'ambulance_id',
        'inventory_id',
        'type',
        'description',
        'scheduled_date',
        'status',
        'cost',
        'proof_image',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];

    public function ambulance()
    {
        return $this->belongsTo(Ambulance::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
