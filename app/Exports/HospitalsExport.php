<?php

namespace App\Exports;

use App\Models\Hospital;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HospitalsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Hospital::select('id', 'name', 'address', 'phone', 'available_beds', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nama Rumah Sakit', 'Alamat', 'Telepon', 'Tempat Tidur Tersedia', 'Dibuat Pada'];
    }
}
