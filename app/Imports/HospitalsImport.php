<?php

namespace App\Imports;

use App\Models\Hospital;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class HospitalsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Hospital([
            'name' => $row['nama_rumah_sakit'] ?? $row['name'],
            'address' => $row['alamat'] ?? $row['address'],
            'phone' => $row['telepon'] ?? $row['phone'],
            'available_beds' => $row['tempat_tidur_tersedia'] ?? $row['available_beds'] ?? 0,
        ]);
    }
}
