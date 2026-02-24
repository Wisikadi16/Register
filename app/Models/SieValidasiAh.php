<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SieValidasiAh extends Model
{
    protected $table = 'sie_validasi_ahs';
    protected $fillable = ['tiket', 'triage', 'evaluasi', 'valid'];
}
