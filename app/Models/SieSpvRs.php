<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SieSpvRs extends Model
{
    protected $table = 'sie_spv_rs';
    protected $fillable = ['rs_id', 'jenis', 'catatan'];
}
