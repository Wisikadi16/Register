<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('ka.dashboard') }}"
                    class="bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-xl px-4 py-2 font-bold shadow-sm transition flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <h2 class="text-3xl font-black text-gray-800 leading-tight border-l-2 border-gray-200 pl-4">
                    <span class="text-blue-600">Laporan</span> Pasien Tertangani
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12 min-h-screen bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            {{-- Bagian Atas: Statistik & Tombol Export --}}
            <div class="flex flex-col md:flex-row justify-between items-center bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
                <div class="flex items-center gap-4 mb-4 md:mb-0">
                    <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-2xl">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Total Pasien Tertangani</h3>
                        <p class="text-slate-500 text-sm"><span class="font-bold text-2xl text-blue-600">{{ isset($laporan) ? $laporan->count() : 0 }}</span> Laporan Selesai</p>
                    </div>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('ka.laporan.pasien.excel') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-2.5 rounded-xl font-bold shadow-sm transition flex items-center gap-2">
                        <i class="fas fa-file-excel"></i> Export CSV/Excel
                    </a>
                    <a href="{{ route('ka.laporan.pasien.pdf') }}" target="_blank" class="bg-rose-500 hover:bg-rose-600 text-white px-5 py-2.5 rounded-xl font-bold shadow-sm transition flex items-center gap-2">
                        <i class="fas fa-file-pdf"></i> Cetak PDF
                    </a>
                </div>
            </div>

            {{-- Tabel Data --}}
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto p-6">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-xs font-bold text-slate-400 uppercase tracking-wider border-b border-slate-200">
                                <th class="px-4 py-3 pb-4">No</th>
                                <th class="px-4 py-3 pb-4">Nama Pelapor</th>
                                <th class="px-4 py-3 pb-4">Nomor HP</th>
                                <th class="px-4 py-3 pb-4">Jenis Darurat</th>
                                <th class="px-4 py-3 pb-4">Tgl & Waktu</th>
                                <th class="px-4 py-3 pb-4 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-slate-600 text-sm">
                            @if(isset($laporan) && $laporan->count() > 0)
                                @foreach($laporan as $index => $row)
                                    <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition">
                                        <td class="px-4 py-4">{{ $index + 1 }}</td>
                                        <td class="px-4 py-4 font-bold text-slate-800">{{ $row->caller_name }}</td>
                                        <td class="px-4 py-4 font-mono">{{ $row->caller_phone }}</td>
                                        <td class="px-4 py-4"><span class="bg-red-50 text-red-600 px-2 py-1 rounded-md text-xs font-bold">{{ $row->emergency_type }}</span></td>
                                        <td class="px-4 py-4 whitespace-nowrap">{{ $row->created_at->format('d M Y, H:i') }}</td>
                                        <td class="px-4 py-4 text-center">
                                            <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold"><i class="fas fa-check-circle mr-1"></i> Selesai</span>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="px-4 py-8 text-center text-slate-500">Belum ada data laporan pasien.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>