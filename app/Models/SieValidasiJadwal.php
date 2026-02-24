<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SieValidasiJadwal extends Model
{
    protected $table = 'sie_validasi_jadwals';
    protected $fillable = ['modul', 'bulan_tahun', 'catatan', 'sah'];
}
