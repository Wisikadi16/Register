<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logistic extends Model
{
    protected $fillable = ['ambulance_id', 'type', 'description', 'amount', 'request_date', 'status'];

    public function ambulance()
    {
        return $this->belongsTo(Ambulance::class);
    }
}
