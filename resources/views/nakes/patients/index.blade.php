<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="mb-4">
                <h2 class="text-3xl font-black text-gray-800">
                    Rekap <span class="text-blue-600">Pasien AH</span>
                </h2>
            </div>

            @if(session('success'))
                <div
                    class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl flex items-center gap-3 shadow-sm mb-2">
                    <i class="fas fa-check-circle text-xl"></i>
                    <p class="font-bold">{{ session('success') }}</p>
                </div>
            @endif

            <div class="flex justify-between items-center bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                <div>
                    <h3 class="text-xl font-black text-slate-800">Riwayat Medis Pasien Darurat</h3>
                    <p class="text-slate-500 text-sm">Data pasien dari panggilan darurat yang telah diselesaikan
                        ("resolved").</p>
                </div>
                <a href="{{ route('nakes.dashboard') }}"
                    class="px-5 py-2.5 bg-slate-100 text-slate-600 font-bold rounded-xl hover:bg-slate-200 transition">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>

            <div class="bg-white p-8 rounded-[2rem] outline-none shadow-sm border border-slate-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="text-xs font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                                <th class="py-4 px-4">Tanggal</th>
                                <th class="py-4 px-4">Kode Panggilan</th>
                                <th class="py-4 px-4">Pasien / Pelapor</th>
                                <th class="py-4 px-4">Keluhan Mayor</th>
                                <th class="py-4 px-4">Ambulans Penjemput</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-medium">
                            @forelse($patients as $p)
                                <tr class="border-b border-slate-50 last:border-0 hover:bg-slate-50/50 transition">
                                    <td class="py-4 px-4 text-slate-500 whitespace-nowrap">
                                        {{ $p->created_at->format('d M Y, H:i') }}
                                    </td>
                                    <td class="py-4 px-4 text-slate-800 font-mono text-sm max-w-[200px] truncate">
                                        {{ $p->id }}
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">
                                                {{ substr($p->caller->name ?? $p->caller_name ?? '?', 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-slate-800 font-black">
                                                    {{ $p->caller->name ?? $p->caller_name ?? 'Anonim' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span class="inline-block max-w-[200px] truncate" title="{{ $p->description }}">
                                            {{ $p->description }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span
                                            class="px-3 py-1 rounded-full bg-slate-100 text-slate-600 border border-slate-200 font-bold text-xs">
                                            {{ $p->ambulance->name ?? 'Manual' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-slate-400 italic">
                                        Belum ada data rekap pasien.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $patients->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>