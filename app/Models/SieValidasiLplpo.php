<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SieValidasiLplpo extends Model
{
    protected $table = 'sie_validasi_lplpos';
    protected $fillable = ['instansi_id', 'bulan', 'status_stok', 'evaluasi', 'sah'];
}
