<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiePkpPuskesmas extends Model
{
    protected $table = 'sie_pkp_puskesmas';
    protected $fillable = ['puskesmas_id', 'periode', 'nilai', 'catatan'];
}
