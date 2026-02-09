<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Page Header -->
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div>
                    <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Rekapitulasi Pasien</h2>
                    <p class="text-slate-500 mt-1">Data lengkap pasien yang telah selesai ditangani.</p>
                </div>
                <button onclick="window.print()"
                    class="bg-slate-800 hover:bg-slate-900 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-slate-500/30 transition transform hover:-translate-y-1 flex items-center gap-2">
                    <i class="fas fa-print"></i> Cetak Rekap
                </button>
            </div>

            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                    <h3 class="font-bold text-lg text-slate-800 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-teal-100 text-teal-600 flex items-center justify-center">
                            <i class="fas fa-user-check"></i>
                        </span>
                        Data Pasien Selesai (Completed)
                    </h3>
                </div>

                <div class="overflow-x-auto p-2">
                    <table class="min-w-full divide-y divide-slate-50">
                        <thead class="bg-white">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">
                                    Waktu Kejadian</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">
                                    Nama Pasien/Pelapor</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">
                                    Lokasi</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">
                                    Ambulans</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">
                                    RS Rujukan</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">
                                    Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-50 text-sm">
                            @forelse($recap as $data)
                                <tr class="hover:bg-slate-50 transition duration-150 group">
                                    <td class="px-6 py-4 whitespace-nowrap font-bold text-slate-600">
                                        {{ $data->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-bold text-slate-800">
                                        {{ $data->user->name }}
                                    </td>
                                    <td class="px-6 py-4 text-slate-500">
                                        <div class="flex items-start gap-1">
                                            <i class="fas fa-map-marker-alt text-red-400 mt-1 shrink-0"></i>
                                            <span class="truncate max-w-[200px] block">{{ $data->location }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($data->ambulance)
                                            <div class="font-medium text-slate-700">{{ $data->ambulance->name }}</div>
                                            <div class="text-[10px] text-slate-400">{{ $data->ambulance->plat_number }}</div>
                                        @else
                                            <span class="text-slate-400 italic">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($data->hospital)
                                            <span
                                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-teal-50 text-teal-700 font-bold text-xs border border-teal-100">
                                                <i class="fas fa-hospital"></i> {{ $data->hospital->name }}
                                            </span>
                                        @else
                                            <span class="text-slate-400 italic text-xs">Tidak dirujuk</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-slate-500 italic max-w-[200px]">
                                        {{ $data->description ?: '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                                        <div
                                            class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3">
                                            <i class="fas fa-user-times text-2xl opacity-30"></i>
                                        </div>
                                        <p class="font-medium text-sm">Belum ada data pasien yang selesai ditangani.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>