<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <a href="{{ route('puskesmas.dashboard') }}"
                        class="inline-flex items-center text-slate-400 hover:text-rose-600 font-bold text-sm mb-2 transition">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
                    </a>
                    <h2 class="text-3xl font-black text-slate-800 tracking-tight">Laporan BHD</h2>
                    <p class="text-slate-500">Dokumentasi kegiatan Bantuan Hidup Dasar.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Form Input Card -->
                <div
                    class="bg-white rounded-[2rem] p-8 shadow-xl shadow-rose-200/20 border border-slate-100 h-fit sticky top-6">
                    <div class="flex items-center gap-4 mb-6">
                        <div
                            class="w-12 h-12 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center text-xl shadow-sm">
                            <i class="fas fa-file-medical-alt"></i>
                        </div>
                        <h3 class="font-bold text-xl text-slate-800">Input Laporan Baru</h3>
                    </div>

                    <form action="{{ route('puskesmas.bhd.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">Tanggal Kegiatan</label>
                            <input type="date" name="tanggal_kegiatan"
                                class="w-full rounded-xl border-slate-200 focus:border-rose-500 focus:ring-rose-500 transition py-3 px-4"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">Lokasi Pelaksanaan</label>
                            <input type="text" name="lokasi" placeholder="Contoh: Balai Desa X"
                                class="w-full rounded-xl border-slate-200 focus:border-rose-500 focus:ring-rose-500 transition py-3 px-4 placeholder:text-slate-300"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">Jumlah Peserta</label>
                            <input type="number" name="jumlah_peserta" placeholder="0"
                                class="w-full rounded-xl border-slate-200 focus:border-rose-500 focus:ring-rose-500 transition py-3 px-4 placeholder:text-slate-300"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">Keterangan / Catatan</label>
                            <textarea name="keterangan" rows="3" placeholder="Deskripsi singkat kegiatan..."
                                class="w-full rounded-xl border-slate-200 focus:border-rose-500 focus:ring-rose-500 transition py-3 px-4 placeholder:text-slate-300"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">Foto Dokumentasi</label>
                            <div
                                class="relative border-2 border-dashed border-slate-300 rounded-2xl p-6 text-center hover:bg-rose-50 hover:border-rose-300 transition group cursor-pointer">
                                <input type="file" name="foto_kegiatan"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required>
                                <div class="text-slate-400 group-hover:text-rose-500">
                                    <i class="fas fa-camera text-2xl mb-2"></i>
                                    <p class="text-xs font-bold">Klik untuk upload foto</p>
                                </div>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-gradient-to-r from-rose-600 to-rose-500 hover:from-rose-700 hover:to-rose-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-rose-500/30 transition transform hover:scale-[1.02] active:scale-95">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim Laporan
                        </button>
                    </form>
                </div>

                <!-- History Grid -->
                <div class="lg:col-span-2">
                    <h3 class="font-bold text-xl text-slate-700 mb-6 flex items-center gap-2">
                        <i class="fas fa-history text-slate-400"></i> Riwayat Laporan
                    </h3>

                    <div class="space-y-6">
                        @forelse($reports as $report)
                            <div
                                class="bg-white rounded-[2rem] p-6 shadow-sm border border-slate-100 hover:shadow-lg transition duration-300 flex flex-col md:flex-row gap-6 group">
                                <!-- Photo Thumbnail -->
                                <div
                                    class="w-full md:w-48 h-48 rounded-2xl overflow-hidden shrink-0 relative bg-slate-100 border border-slate-100">
                                    <img src="{{ asset('storage/' . $report->foto_kegiatan) }}"
                                        class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500"
                                        alt="Foto Kegiatan">
                                    <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition"></div>
                                </div>

                                <!-- Content -->
                                <div class="flex-1 py-2">
                                    <div class="flex flex-wrap items-center gap-3 mb-3">
                                        <span
                                            class="bg-rose-100 text-rose-700 text-xs font-black px-3 py-1 rounded-full uppercase tracking-wider">
                                            <i class="fas fa-calendar-alt mr-1"></i>
                                            {{ \Carbon\Carbon::parse($report->tanggal_kegiatan)->format('d M Y') }}
                                        </span>
                                        <span class="bg-slate-100 text-slate-600 text-xs font-bold px-3 py-1 rounded-full">
                                            <i class="fas fa-users mr-1"></i> {{ $report->jumlah_peserta }} Peserta
                                        </span>
                                    </div>
                                    <h4 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-rose-600 transition">
                                        {{ $report->lokasi }}</h4>
                                    <p class="text-slate-500 text-sm leading-relaxed mb-4 line-clamp-2">
                                        {{ $report->keterangan ?? 'Tidak ada keterangan tambahan.' }}
                                    </p>
                                    <div class="text-xs text-slate-300 font-mono">
                                        ID Laporan: #{{ $report->id }} &bull; Dibuat
                                        {{ $report->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div
                                class="bg-white rounded-[2rem] p-12 text-center shadow-sm border border-slate-100 border-dashed">
                                <div
                                    class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                                    <i class="fas fa-folder-open text-4xl"></i>
                                </div>
                                <h3 class="text-lg font-bold text-slate-600">Belum ada laporan</h3>
                                <p class="text-slate-400 text-sm">Laporan BHD yang Anda input akan muncul di sini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>