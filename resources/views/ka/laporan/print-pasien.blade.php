<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pasien Tertangani</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            @page {
                size: landscape;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body class="bg-white text-gray-800 p-8" onload="window.print()">

    <!-- Header Laporan -->
    <div class="text-center mb-8 border-b-2 border-gray-800 pb-4">
        <h1 class="text-2xl font-bold uppercase">Laporan Rekapitulasi Pasien Tertangani</h1>
        <h2 class="text-xl font-semibold">Sistem Terpadu Kegawatdaruratan (Ambulan Hebat)</h2>
        <p class="text-gray-600 mt-2">Dicetak pada: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
    </div>

    <!-- Tombol Print Manual (Sembunyi saat diprint) -->
    <div class="mb-4 no-print text-center">
        <button onclick="window.print()"
            class="bg-blue-600 text-white px-6 py-2 rounded shadow font-bold hover:bg-blue-700">
            Cetak Ulang / Simpan PDF
        </button>
        <p class="text-sm text-gray-500 mt-2">Tips: Pada jendela Print, pilih "Save as PDF" jika ingin menyimpannya.</p>
    </div>

    <!-- Tabel Data -->
    <table class="w-full text-left border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100 text-sm">
                <th class="border border-gray-300 p-2 text-center">No</th>
                <th class="border border-gray-300 p-2">Nama Pelapor</th>
                <th class="border border-gray-300 p-2">Nomor Telepon</th>
                <th class="border border-gray-300 p-2">Jenis Darurat</th>
                <th class="border border-gray-300 p-2">Lokasi Kejadian</th>
                <th class="border border-gray-300 p-2">Tanggal & Waktu</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporan as $index => $row)
                <tr class="text-sm hover:bg-gray-50">
                    <td class="border border-gray-300 p-2 text-center">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 p-2 font-semibold">{{ $row->caller_name }}</td>
                    <td class="border border-gray-300 p-2">{{ $row->caller_phone }}</td>
                    <td class="border border-gray-300 p-2"><span
                            class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs font-bold">{{ $row->emergency_type }}</span>
                    </td>
                    <td class="border border-gray-300 p-2">{{ $row->location }}</td>
                    <td class="border border-gray-300 p-2">{{ $row->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="border border-gray-300 p-4 text-center text-gray-500">Belum ada data pasien yang
                        tertangani (Selesai).</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>