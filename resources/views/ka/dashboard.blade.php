<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-3xl font-black text-charcoal tracking-tight">
                    Dashboard <span class="text-blue-600 font-semibold">KA (Koor & Sub Koor)</span>
                </h2>
                <p class="text-slate-500 font-medium mt-1">Pusat Validasi & Cetak Laporan Operasional</p>
            </div>
            <div class="bg-white border border-slate-200 px-5 py-2.5 rounded-full flex items-center gap-3 shadow-sm">
                <i class="fas fa-calendar-alt text-slate-400"></i>
                <span class="text-sm font-bold text-slate-700">
                    {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-10 min-h-screen bg-slate-50 font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- WELCOME BANNER (Minimalist & Premium) --}}
            <div
                class="bg-gradient-to-r from-rescue-red to-red-600 rounded-[2rem] p-8 md:p-10 shadow-lg flex flex-col md:flex-row items-center justify-between gap-8 relative overflow-hidden group">
                <div
                    class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full blur-3xl opacity-10 -translate-y-1/2 translate-x-1/2 pattern-grid-lg text-white">
                </div>

                <div class="relative z-10 max-w-2xl text-center md:text-left">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white/20 border border-white/20 text-white text-[10px] font-black uppercase tracking-widest mb-4 shadow-sm backdrop-blur-sm">
                        <i class="fas fa-user-shield text-white"></i> Koordinator Ambulan Hebat
                    </div>
                    <h1 class="text-3xl md:text-4xl font-black text-white tracking-tight mb-2">
                        Halo, {{ Auth::user()->name }} 👋
                    </h1>
                    <p class="text-red-50 text-base leading-relaxed">
                        Pantau keseluruhan kinerja operasional, lakukan validasi data medis, dan hasilkan laporan
                        rekapitulasi secara komprehensif.
                    </p>
                </div>

                <div
                    class="relative z-10 hidden md:flex w-32 h-32 bg-white/20 border border-white/20 rounded-[2rem] shadow-inner items-center justify-center text-white/70 text-6xl group-hover:scale-105 group-hover:-rotate-3 transition duration-700 backdrop-blur-sm">
                    <i class="fas fa-chart-line text-white"></i>
                </div>
            </div>

            <div class="flex items-center gap-3 pl-2 mt-8 mb-4">
                <div class="w-8 h-8 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center text-sm">
                    <i class="fas fa-layer-group"></i>
                </div>
                <h3 class="text-lg font-bold text-charcoal">Menu Koordinator</h3>
            </div>

            {{-- GRID MENU --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
                <!-- Menu 1 -->
                <a href="{{ route('ka.laporan.pasien') }}"
                    class="group bg-white rounded-[2rem] p-8 shadow-sm hover:shadow-lg border border-slate-100 hover:border-blue-300 transition-all duration-300 flex flex-col items-center text-center relative overflow-hidden hover:-translate-y-1">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div
                        class="w-16 h-16 bg-slate-50 text-blue-600 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-sm group-hover:scale-110 transition-transform duration-300 relative z-10">
                        <i class="fas fa-file-medical"></i>
                    </div>
                    <h4
                        class="font-black text-charcoal text-base mb-2 group-hover:text-blue-600 transition-colors relative z-10">
                        Laporan Pasien</h4>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest relative z-10">Pasien
                        Tertangani</p>
                </a>

                <!-- Menu 2 -->
                <a href="{{ route('ka.laporan.team') }}"
                    class="group bg-white rounded-[2rem] p-8 shadow-sm hover:shadow-lg border border-slate-100 hover:border-indigo-300 transition-all duration-300 flex flex-col items-center text-center relative overflow-hidden hover:-translate-y-1">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-indigo-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div
                        class="w-16 h-16 bg-slate-50 text-indigo-600 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-sm group-hover:scale-110 transition-transform duration-300 relative z-10">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <h4
                        class="font-black text-charcoal text-base mb-2 group-hover:text-indigo-600 transition-colors relative z-10">
                        Laporan Team</h4>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest relative z-10">Kinerja
                        Petugas</p>
                </a>

                <!-- Menu 3 -->
                <a href="{{ route('ka.laporan.rekam') }}"
                    class="group bg-white rounded-[2rem] p-8 shadow-sm hover:shadow-lg border border-slate-100 hover:border-teal-300 transition-all duration-300 flex flex-col items-center text-center relative overflow-hidden hover:-translate-y-1">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-teal-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div
                        class="w-16 h-16 bg-slate-50 text-teal-600 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-sm group-hover:scale-110 transition-transform duration-300 relative z-10">
                        <i class="fas fa-database"></i>
                    </div>
                    <h4
                        class="font-black text-charcoal text-base mb-2 group-hover:text-teal-600 transition-colors relative z-10">
                        Rekam Data Pasien</h4>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest relative z-10">Arsip Medis
                    </p>
                </a>

                <!-- Menu 4 -->
                <a href="{{ route('ka.validasi.index') }}"
                    class="group bg-white rounded-[2rem] p-8 shadow-sm hover:shadow-lg border border-slate-100 hover:border-rescue-red/30 transition-all duration-300 flex flex-col items-center text-center relative overflow-hidden hover:-translate-y-1">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-red-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div
                        class="w-16 h-16 bg-slate-50 text-rescue-red rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-sm group-hover:scale-110 transition-transform duration-300 relative z-10">
                        <i class="fas fa-check-double"></i>
                    </div>
                    <h4
                        class="font-black text-charcoal text-base mb-2 group-hover:text-rescue-red transition-colors relative z-10">
                        Validasi Laporan</h4>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest relative z-10">Verifikasi
                        Berkas</p>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>