<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-3xl font-black text-charcoal tracking-tight">
                    Dashboard <span class="text-indigo-600 font-semibold">Sie Rujukan</span>
                </h2>
                <p class="text-slate-500 font-medium mt-1">Pusat Validasi, Supervisi & Evaluasi Faskes</p>
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
                        <i class="fas fa-chart-line text-white"></i> Monitoring Sistem
                    </div>
                    <h1 class="text-3xl md:text-4xl font-black text-white tracking-tight mb-2">
                        Halo, {{ Auth::user()->name }} 👋
                    </h1>
                    <p class="text-red-50 text-base leading-relaxed">
                        Pantau operasional faskes, validasi rujukan, dan jalankan supervisi secara terpusat demi
                        mewujudkan layanan kesehatan darurat yang prima.
                    </p>
                </div>

                <div
                    class="relative z-10 hidden md:flex w-32 h-32 bg-white/20 border border-white/20 rounded-[2rem] shadow-inner items-center justify-center text-white/70 text-6xl group-hover:scale-105 group-hover:rotate-3 transition duration-700 backdrop-blur-sm">
                    <i class="fas fa-user-md text-white"></i>
                </div>
            </div>

            <div class="flex items-center gap-3 pl-2 mt-8 mb-4">
                <div class="w-8 h-8 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center text-sm">
                    <i class="fas fa-search-plus"></i>
                </div>
                <h3 class="text-lg font-bold text-charcoal">Modul Supervisi & Evaluasi</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                <!-- PKP Puskesmas -->
                <a href="{{ route('sie.pkp.puskesmas') }}"
                    class="group bg-white rounded-[2rem] p-8 shadow-sm hover:shadow-lg border border-slate-100 hover:border-blue-300 transition-all duration-300 relative overflow-hidden flex flex-col items-start gap-3 hover:-translate-y-1">
                    <div
                        class="w-14 h-14 bg-slate-50 group-hover:bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl shadow-sm transition-colors duration-300">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-charcoal text-lg mb-1 group-hover:text-blue-600 transition-colors">
                            PKP Puskesmas</h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Penilaian kinerja & skor layanan Puskesmas</p>
                    </div>
                    <i
                        class="fas fa-chart-pie absolute -right-4 -bottom-4 text-7xl text-slate-50 opacity-50 transform -rotate-12 group-hover:rotate-0 transition duration-700"></i>
                </a>

                <!-- SPV Puskesmas -->
                <a href="{{ route('sie.spv.puskesmas') }}"
                    class="group bg-white rounded-[2rem] p-8 shadow-sm hover:shadow-lg border border-slate-100 hover:border-teal-300 transition-all duration-300 relative overflow-hidden flex flex-col items-start gap-3 hover:-translate-y-1">
                    <div
                        class="w-14 h-14 bg-slate-50 group-hover:bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center text-2xl shadow-sm transition-colors duration-300">
                        <i class="fas fa-clinic-medical"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-charcoal text-lg mb-1 group-hover:text-teal-600 transition-colors">
                            SPV Puskesmas</h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Supervisi langsung ke fasilitas Puskesmas</p>
                    </div>
                    <i
                        class="fas fa-stethoscope absolute -right-4 -bottom-4 text-7xl text-slate-50 opacity-50 transform -rotate-12 group-hover:rotate-0 transition duration-700"></i>
                </a>

                <!-- SPV RS -->
                <a href="{{ route('sie.spv.rs') }}"
                    class="group bg-white rounded-[2rem] p-8 shadow-sm hover:shadow-lg border border-slate-100 hover:border-indigo-300 transition-all duration-300 relative overflow-hidden flex flex-col items-start gap-3 hover:-translate-y-1">
                    <div
                        class="w-14 h-14 bg-slate-50 group-hover:bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center text-2xl shadow-sm transition-colors duration-300">
                        <i class="fas fa-hospital-alt"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-charcoal text-lg mb-1 group-hover:text-indigo-600 transition-colors">
                            SPV Rumah Sakit</h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Audit kelayakan rujukan & IGD Rumah Sakit</p>
                    </div>
                    <i
                        class="fas fa-hospital absolute -right-4 -bottom-4 text-7xl text-slate-50 opacity-50 transform -rotate-12 group-hover:rotate-0 transition duration-700"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-12">
                <!-- Stratifikasi RS -->
                <a href="{{ route('sie.stratifikasi.rs') }}"
                    class="group bg-white rounded-[2rem] p-8 shadow-sm hover:shadow-lg border border-slate-100 hover:border-purple-300 transition-all duration-300 flex items-start gap-6 hover:-translate-y-1">
                    <div
                        class="w-16 h-16 bg-slate-50 group-hover:bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center text-2xl flex-shrink-0 shadow-sm transition-colors duration-300">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-charcoal text-xl mb-2 group-hover:text-purple-600 transition-colors">
                            Stratifikasi RS</h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Kelola validasi kenaikan kelas dan tipe Rumah
                            Sakit di seluruh wilayah administratif.</p>
                        <div
                            class="mt-4 inline-flex items-center gap-2 text-xs font-bold text-purple-600 group-hover:translate-x-2 transition-transform">
                            Buka Modul <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>

                <div class="grid grid-cols-2 gap-6">
                    <!-- SPV Klinik -->
                    <a href="{{ route('sie.spv.klinik') }}"
                        class="group bg-white rounded-[2rem] p-6 shadow-sm hover:shadow-lg border border-slate-100 hover:border-pink-300 transition-all duration-300 flex flex-col justify-center items-center text-center relative overflow-hidden hover:-translate-y-1">
                        <div
                            class="w-12 h-12 bg-slate-50 group-hover:bg-pink-50 text-pink-600 rounded-2xl flex items-center justify-center text-xl mb-3 shadow-sm transition-colors duration-300">
                            <i class="fas fa-briefcase-medical"></i>
                        </div>
                        <h4 class="font-black text-charcoal mb-1 group-hover:text-pink-600 transition-colors">SPV Klinik
                        </h4>
                        <p class="text-[11px] font-bold text-slate-400 tracking-widest uppercase">Izin Utama</p>
                    </a>

                    <!-- SPV Lab -->
                    <a href="{{ route('sie.spv.lab') }}"
                        class="group bg-white rounded-[2rem] p-6 shadow-sm hover:shadow-lg border border-slate-100 hover:border-cyan-300 transition-all duration-300 flex flex-col justify-center items-center text-center relative overflow-hidden hover:-translate-y-1">
                        <div
                            class="w-12 h-12 bg-slate-50 group-hover:bg-cyan-50 text-cyan-600 rounded-2xl flex items-center justify-center text-xl mb-3 shadow-sm transition-colors duration-300">
                            <i class="fas fa-microscope"></i>
                        </div>
                        <h4 class="font-black text-charcoal mb-1 group-hover:text-cyan-600 transition-colors">SPV Lab
                            Medis</h4>
                        <p class="text-[11px] font-bold text-slate-400 tracking-widest uppercase">Uji Alat</p>
                    </a>
                </div>
            </div>

            <!-- Separator -->
            <div class="flex items-center gap-3 pl-2 mt-8 mb-4">
                <div class="w-8 h-8 bg-orange-50 text-orange-600 rounded-lg flex items-center justify-center text-sm">
                    <i class="fas fa-check-double"></i>
                </div>
                <h3 class="text-lg font-bold text-charcoal">Penilaian & Validasi Khusus</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Validasi Data AH -->
                <a href="{{ route('sie.validasi.ah') }}"
                    class="col-span-1 md:col-span-2 bg-rescue-red rounded-[2rem] p-8 shadow-lg shadow-rescue-red/20 hover:shadow-2xl hover:shadow-rescue-red/30 transition-all duration-300 group relative overflow-hidden transform hover:-translate-y-1">
                    <div
                        class="absolute -right-6 -bottom-6 opacity-10 text-white text-9xl transform -rotate-12 group-hover:rotate-0 transition duration-700">
                        <i class="fas fa-ambulance"></i>
                    </div>
                    <div class="relative z-10 flex flex-col h-full justify-center">
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white/20 text-white text-[10px] font-black tracking-widest uppercase mb-3 w-max backdrop-blur-sm shadow-sm">
                            <i class="fas fa-bolt"></i> Prioritas Tinggi
                        </div>
                        <h4 class="font-black text-white text-2xl mb-2 drop-shadow-sm">Validasi Data AH</h4>
                        <p class="text-white/80 text-sm max-w-sm leading-relaxed">
                            Periksa kesesuaian tindakan rujukan, triage, dan SOP operasional Ambulan Hebat di lapangan.
                        </p>
                    </div>
                </a>

                <!-- Validasi Jadwal -->
                <a href="{{ route('sie.validasi.jadwal') }}"
                    class="group bg-white rounded-[2rem] p-6 shadow-sm hover:shadow-lg border border-slate-100 hover:border-orange-300 transition-all duration-300 flex flex-col items-center justify-center text-center relative hover:-translate-y-1">
                    <div
                        class="w-14 h-14 bg-slate-50 group-hover:bg-orange-50 text-orange-500 rounded-full flex items-center justify-center text-2xl mb-4 shadow-sm transition-colors duration-300 group-hover:scale-110">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h4 class="font-black text-charcoal mb-1 group-hover:text-orange-500 transition-colors">Validasi
                        Jadwal</h4>
                    <p class="text-[10px] font-bold text-slate-400 tracking-widest uppercase">Persetujuan Shift</p>
                </a>

                <!-- Validasi LPLPO -->
                <a href="{{ route('sie.validasi.lplpo') }}"
                    class="group bg-white rounded-[2rem] p-6 shadow-sm hover:shadow-lg border border-slate-100 hover:border-amber-300 transition-all duration-300 flex flex-col items-center justify-center text-center relative hover:-translate-y-1">
                    <div
                        class="w-14 h-14 bg-slate-50 group-hover:bg-amber-50 text-amber-500 rounded-full flex items-center justify-center text-2xl mb-4 shadow-sm transition-colors duration-300 group-hover:scale-110">
                        <i class="fas fa-pills"></i>
                    </div>
                    <h4 class="font-black text-charcoal mb-1 group-hover:text-amber-500 transition-colors">Validasi
                        LPLPO</h4>
                    <p class="text-[10px] font-bold text-slate-400 tracking-widest uppercase">Review Stok Obat</p>
                </a>
            </div>

            <!-- Laporan BHD Footer -->
            <a href="{{ route('sie.laporan.bhd') }}"
                class="group bg-white rounded-[2rem] p-8 shadow-sm hover:shadow-lg border border-slate-100 hover:border-emerald-300 flex items-center justify-between transition-all duration-300 relative overflow-hidden mb-16 hover:-translate-y-1">
                <div
                    class="absolute inset-0 bg-gradient-to-r from-emerald-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div class="flex items-center gap-6 relative z-10">
                    <div
                        class="w-16 h-16 bg-slate-50 group-hover:bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-3xl shadow-sm transition-colors duration-300">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <div>
                        <h4
                            class="font-black text-charcoal text-xl mb-1 group-hover:text-emerald-600 transition-colors">
                            Cetak Laporan Bantuan Hidup Dasar (BHD)
                        </h4>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            Dokumentasi dan pencetakan riwayat pelatihan kegawatdaruratan medik harian untuk masyarakat.
                        </p>
                    </div>
                </div>
                <div
                    class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center text-xl shadow-sm group-hover:bg-emerald-500 group-hover:text-white transition-all duration-300 relative z-10">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </a>

        </div>
    </div>
</x-app-layout>