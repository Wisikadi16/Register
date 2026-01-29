<?php

namespace App\Imports;

use App\Models\Basecamp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BasecampsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Basecamp([
            'name' => $row['nama_puskesmas'] ?? $row['name'],
            'address' => $row['alamat'] ?? $row['address'],
            'phone' => $row['telepon'] ?? $row['phone'],
        ]);
    }
}
