<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SieSpvLab extends Model
{
    protected $table = 'sie_spv_lab';
    protected $fillable = ['lab_id', 'target', 'catatan'];
}
