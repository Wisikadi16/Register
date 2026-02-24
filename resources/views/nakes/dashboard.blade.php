<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-3xl font-black text-charcoal tracking-tight">
                    Dashboard <span class="text-blue-600 font-semibold">Tenaga Medis</span>
                </h2>
                <p class="text-slate-500 font-medium mt-1">Sistem Manajemen Rekam Medis & Usulan</p>
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
                        <i class="fas fa-user-nurse text-white"></i> Tim Medis Utama
                    </div>
                    <h1 class="text-3xl md:text-4xl font-black text-white tracking-tight mb-2">
                        Halo, {{ Auth::user()->name }} 👋
                    </h1>
                    <p class="text-red-50 text-base leading-relaxed">
                        Akses khusus bagi tenaga kesehatan untuk mengelola data pasien, rekam medis darurat, serta
                        mengajukan laporan insentif / usulan logistik.
                    </p>
                </div>

                <div
                    class="relative z-10 hidden md:flex w-32 h-32 bg-white/20 border border-white/20 rounded-[2rem] shadow-inner items-center justify-center text-white/70 text-6xl group-hover:scale-105 group-hover:rotate-3 transition duration-700 backdrop-blur-sm">
                    <i class="fas fa-stethoscope text-white"></i>
                </div>
            </div>

            <div class="flex items-center gap-3 pl-2 mt-8 mb-4">
                <div class="w-8 h-8 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center text-sm">
                    <i class="fas fa-briefcase-medical"></i>
                </div>
                <h3 class="text-lg font-bold text-charcoal">Fasilitas Medis</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16 mt-8">
                <!-- Rekap Pasien AH -->
                <a href="{{ route('nakes.patients.index') }}"
                    class="group bg-white rounded-[2rem] p-8 shadow-sm hover:shadow-lg border border-slate-100 hover:border-blue-300 transition-all duration-300 relative overflow-hidden flex flex-col items-start gap-4 hover:-translate-y-1">

                    <div
                        class="w-16 h-16 bg-slate-50 group-hover:bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-3xl shadow-sm transition-colors duration-300">
                        <i class="fas fa-file-medical-alt"></i>
                    </div>

                    <div>
                        <h4 class="font-black text-charcoal text-xl mb-2 group-hover:text-blue-600 transition-colors">
                            Rekap Pasien AH</h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Lihat riwayat darurat lengkap dan akses data
                            rekam medis pasien yang telah ditangani oleh tim ambulans.</p>
                    </div>

                    <div
                        class="mt-4 inline-flex items-center gap-2 text-xs font-bold text-blue-600 group-hover:translate-x-2 transition-transform">
                        Buka Rekap <i class="fas fa-arrow-right"></i>
                    </div>

                    <i
                        class="fas fa-notes-medical absolute -right-6 -bottom-6 text-9xl text-slate-50 opacity-50 transform -rotate-12 group-hover:rotate-0 transition duration-700"></i>
                </a>

                <!-- Input Data Pasien -->
                <a href="{{ route('nakes.patients.create') }}"
                    class="group bg-white rounded-[2rem] p-8 shadow-sm hover:shadow-lg border border-slate-100 hover:border-teal-300 transition-all duration-300 relative overflow-hidden flex flex-col items-start gap-4 hover:-translate-y-1">

                    <div
                        class="w-16 h-16 bg-slate-50 group-hover:bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center text-3xl shadow-sm transition-colors duration-300">
                        <i class="fas fa-user-injured"></i>
                    </div>

                    <div>
                        <h4 class="font-black text-charcoal text-xl mb-2 group-hover:text-teal-600 transition-colors">
                            Input Data Pasien</h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Isi formulir lengkap untuk pendataan
                            tanda-tanda vital (TTV) dan detail riwayat medis pasien rujukan baru.</p>
                    </div>

                    <div
                        class="mt-4 inline-flex items-center gap-2 text-xs font-bold text-teal-600 group-hover:translate-x-2 transition-transform">
                        Buat Laporan Baru <i class="fas fa-arrow-right"></i>
                    </div>

                    <i
                        class="fas fa-heartbeat absolute -right-6 -bottom-6 text-9xl text-slate-50 opacity-50 transform -rotate-12 group-hover:rotate-0 transition duration-700"></i>
                </a>

                <!-- Laporan Usulan -->
                <a href="{{ route('nakes.reports.index') }}"
                    class="group bg-white rounded-[2rem] p-8 shadow-sm hover:shadow-lg border border-slate-100 hover:border-amber-300 transition-all duration-300 relative overflow-hidden flex flex-col items-start gap-4 hover:-translate-y-1">

                    <div
                        class="w-16 h-16 bg-slate-50 group-hover:bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center text-3xl shadow-sm transition-colors duration-300">
                        <i class="fas fa-clipboard-list"></i>
                    </div>

                    <div>
                        <h4 class="font-black text-charcoal text-xl mb-2 group-hover:text-amber-500 transition-colors">
                            Laporan Usulan</h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Buat dokumen pengajuan insentif layanan,
                            permintaan suplai fasilitas medis, dan pelaporan kendala di lapangan.</p>
                    </div>

                    <div
                        class="mt-4 inline-flex items-center gap-2 text-xs font-bold text-amber-500 group-hover:translate-x-2 transition-transform">
                        Kirim Usulan <i class="fas fa-arrow-right"></i>
                    </div>

                    <i
                        class="fas fa-clipboard-check absolute -right-6 -bottom-6 text-9xl text-slate-50 opacity-50 transform -rotate-12 group-hover:rotate-0 transition duration-700"></i>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>