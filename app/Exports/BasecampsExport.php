<?php

namespace App\Exports;

use App\Models\Basecamp;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BasecampsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Basecamp::select('id', 'name', 'address', 'phone', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nama Puskesmas', 'Alamat', 'Telepon', 'Dibuat Pada'];
    }
}
