<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SieStratifikasiRs extends Model
{
    protected $table = 'sie_stratifikasi_rs';
    protected $fillable = ['rs_id', 'tipe_lama', 'tipe_baru', 'analisis'];
}
