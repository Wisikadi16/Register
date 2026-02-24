<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SieSpvPuskesmas extends Model
{
    protected $table = 'sie_spv_puskesmas';
    protected $fillable = ['puskesmas_id', 'aspek', 'temuan', 'rekomendasi'];
}
