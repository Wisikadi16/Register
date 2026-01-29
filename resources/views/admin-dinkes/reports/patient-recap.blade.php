<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            📈 Rekap Pasien AH (Laporan Lengkap)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-xl font-bold">Data Rekapitulasi Pasien</h3>
                            <p class="text-sm text-gray-500">Menampilkan data pasien yang telah selesai ditangani (Status: Completed)</p>
                        </div>
                        <button onclick="window.print()" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded shadow transition text-sm">
                            🖨️ Cetak Rekap
                        </button>
                    </div>

                    <div class="overflow-x-auto border rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Waktu Kejadian</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Nama Pasien/Pelapor</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Alamat Lokasi</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Ambulans Penolong</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Rumah Sakit Rujukan</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Keterangan Medis</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                @forelse($recap as $data)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $data->created_at->format('d M Y H:i') }}</td>
                                        <td class="px-6 py-4 font-bold text-gray-900">{{ $data->user->name }}</td>
                                        <td class="px-6 py-4 text-gray-600">{{ $data->location }}</td>
                                        <td class="px-6 py-4">
                                            <span class="font-medium">{{ $data->ambulance->name ?? '-' }}</span>
                                            <div class="text-xs text-gray-400">{{ $data->ambulance->plat_number ?? '' }}</div>
                                        </td>
                                        <td class="px-6 py-4 font-bold text-teal-700">{{ $data->hospital->name ?? 'Dibatalkan/Manual' }}</td>
                                        <td class="px-6 py-4 text-gray-500 italic">{{ $data->description ?: '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-10 text-center text-gray-400 italic">Belum ada data pasien yang selesai ditangani.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
