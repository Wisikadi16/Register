<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SieSpvKlinik extends Model
{
    protected $table = 'sie_spv_klinik';
    protected $fillable = ['klinik_id', 'kategori', 'inspeksi'];
}
