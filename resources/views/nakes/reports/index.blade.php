<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="mb-4">
                <h2 class="text-3xl font-black text-gray-800">
                    Laporan <span class="text-orange-600">Usulan Nakes</span>
                </h2>
            </div>

            <div class="flex justify-between items-center bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                <div>
                    <h3 class="text-xl font-black text-slate-800">Manajemen Laporan & Usulan</h3>
                    <p class="text-slate-500 text-sm">Sampaikan usulan logistik, keluhan fasilitas, atau perbaikan
                        sistem ke Admin.</p>
                </div>
                <a href="{{ route('nakes.dashboard') }}"
                    class="px-5 py-2.5 bg-slate-100 text-slate-600 font-bold rounded-xl hover:bg-slate-200 transition">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>

            @if(session('success'))
                <div
                    class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl flex items-center gap-3 shadow-sm">
                    <i class="fas fa-check-circle text-xl"></i>
                    <p class="font-bold">{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- KIRI: Form Input -->
                <div class="lg:col-span-1">
                    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 sticky top-6">
                        <div
                            class="w-12 h-12 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center text-xl mb-6">
                            <i class="fas fa-pen-alt"></i>
                        </div>
                        <h4 class="text-lg font-black text-slate-800 mb-6 border-b pb-4">Buat Usulan Baru</h4>

                        <form action="{{ route('nakes.reports.store') }}" method="POST" class="space-y-5">
                            @csrf
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Judul Usulan / Topik</label>
                                <input type="text" name="judul_usulan" required
                                    class="w-full rounded-xl border-slate-200 focus:border-orange-500 focus:ring-orange-500 bg-slate-50"
                                    placeholder="Cth: Kekurangan Stok O2">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi Detail</label>
                                <textarea name="deskripsi" rows="5" required
                                    class="w-full rounded-xl border-slate-200 focus:border-orange-500 focus:ring-orange-500 bg-slate-50"
                                    placeholder="Jelaskan secara rinci usulan atau masalah yang dihadapi..."></textarea>
                            </div>

                            <button type="submit"
                                class="w-full py-3 bg-orange-600 hover:bg-orange-700 text-white font-bold rounded-xl shadow-lg shadow-orange-500/30 transition-all transform hover:scale-105 active:scale-95">
                                <i class="fas fa-paper-plane mr-2"></i> Kirim Usulan
                            </button>
                        </form>
                    </div>
                </div>

                <!-- KANAN: Tabel Riwayat Usulan -->
                <div class="lg:col-span-2">
                    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 h-full">
                        <h4 class="text-lg font-black text-slate-800 mb-6"><i
                                class="fas fa-history text-slate-400 mr-2"></i> Riwayat Usulan Anda</h4>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr
                                        class="text-xs font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                                        <th class="py-4 px-4">Tanggal</th>
                                        <th class="py-4 px-4">Judul Usulan</th>
                                        <th class="py-4 px-4">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm">
                                    @forelse($reports as $r)
                                        <tr class="border-b border-slate-50 last:border-0 hover:bg-slate-50/50 transition">
                                            <td class="py-4 px-4 text-slate-500 whitespace-nowrap">
                                                {{ $r->created_at->format('d M Y, H:i') }}
                                            </td>
                                            <td class="py-4 px-4">
                                                <p class="font-bold text-slate-800">{{ $r->judul_usulan }}</p>
                                                <p class="text-xs text-slate-500 mt-1 line-clamp-1">{{ $r->deskripsi }}</p>
                                            </td>
                                            <td class="py-4 px-4">
                                                @if($r->status == 'pending')
                                                    <span
                                                        class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold border border-yellow-200">
                                                        <i class="fas fa-clock mr-1"></i> Menunggu
                                                    </span>
                                                @elseif($r->status == 'diproses')
                                                    <span
                                                        class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold border border-blue-200">
                                                        <i class="fas fa-spinner fa-spin mr-1"></i> Diproses
                                                    </span>
                                                @else
                                                    <span
                                                        class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-bold border border-emerald-200">
                                                        <i class="fas fa-check mr-1"></i> Selesai
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="py-8 text-center text-slate-400 italic">
                                                Anda belum pernah membuat laporan usulan.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>