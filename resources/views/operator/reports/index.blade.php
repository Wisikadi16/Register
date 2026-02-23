<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <a href="{{ route('operator.dashboard') }}"
                class="inline-flex items-center text-slate-500 hover:text-purple-600 font-bold mb-6 transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
            </a>

            <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h3 class="text-2xl font-black text-gray-800">📋 Rekap Laporan Pasien</h3>
                        <p class="text-gray-500">Arsip panggilan darurat yang telah selesai ditangani.</p>
                    </div>
                    <button
                        class="bg-purple-50 text-purple-700 px-4 py-2 rounded-xl font-bold flex items-center gap-2 hover:bg-purple-100 transition">
                        <i class="fas fa-download"></i> Export Data
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 text-slate-500 uppercase text-xs font-bold">
                            <tr>
                                <th class="px-6 py-4 rounded-l-xl">Tanggal</th>
                                <th class="px-6 py-4">Pasien / Pelapor</th>
                                <th class="px-6 py-4">Lokasi</th>
                                <th class="px-6 py-4">Unit Penangan</th>
                                <th class="px-6 py-4">RS Tujuan</th>
                                <th class="px-6 py-4 rounded-r-xl">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($reports as $report)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-6 py-4 font-mono text-sm">{{ $report->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-800">{{ $report->user->name ?? 'Anonim' }}</div>
                                        <div class="text-xs text-gray-400">{{ $report->user->phone_number ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 truncate max-w-xs">{{ $report->address }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="bg-teal-50 text-teal-700 px-3 py-1 rounded-full text-xs font-bold">
                                            {{ $report->ambulance->name ?? 'Non-Dinas' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-700">{{ $report->hospital->name ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        <span class="text-green-600 font-bold flex items-center gap-1">
                                            <i class="fas fa-check-circle"></i> Selesai
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-12 text-gray-400">Belum ada laporan selesai.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $reports->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>