<?php

namespace App\Exports;

use App\Models\Ambulance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AmbulancesExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Ambulance::with('basecamp')->get();
    }

    public function map($ambulance): array
    {
        return [
            $ambulance->id,
            $ambulance->plat_number,
            $ambulance->name,
            $ambulance->basecamp->name ?? '-',
            $ambulance->status,
            $ambulance->current_latitude,
            $ambulance->current_longitude,
            $ambulance->created_at,
        ];
    }

    public function headings(): array
    {
        return ['ID', 'Plat Nomor', 'Nama Ambulan', 'Basecamp', 'Status', 'Latitude', 'Longitude', 'Dibuat Pada'];
    }
}
