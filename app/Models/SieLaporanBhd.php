<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SieLaporanBhd extends Model
{
    protected $table = 'sie_laporan_bhds';
    protected $fillable = ['periode', 'lokasi', 'keterangan'];
}
