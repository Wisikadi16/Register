<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utility extends Model
{
    protected $fillable = ['type', 'amount', 'billing_period', 'proof_path', 'status'];
}
