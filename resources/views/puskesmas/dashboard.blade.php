<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-3xl font-black text-charcoal tracking-tight">
                    Dashboard <span class="text-blue-600 font-semibold">Puskesmas</span>
                </h2>
                <p class="text-slate-500 font-medium mt-1">Sistem Manajemen SPV & Laporan BHD</p>
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
                        <i class="fas fa-building text-white"></i> Puskesmas & Lab Medik
                    </div>
                    <h1 class="text-3xl md:text-4xl font-black text-white tracking-tight mb-2">
                        Halo, {{ Auth::user()->name }} 👋
                    </h1>
                    <p class="text-red-50 text-base leading-relaxed">
                        Sistem Informasi terpadu untuk pendataan Supervisor operasional dan pencatatan riwayat kegiatan
                        Bantuan Hidup Dasar (BHD).
                    </p>
                </div>

                <div
                    class="relative z-10 hidden md:flex w-32 h-32 bg-white/20 border border-white/20 rounded-[2rem] shadow-inner items-center justify-center text-white/70 text-6xl group-hover:scale-105 group-hover:rotate-3 transition duration-700 backdrop-blur-sm">
                    <i class="fas fa-clinic-medical text-white"></i>
                </div>
            </div>

            <div class="flex items-center gap-3 pl-2 mt-8 mb-4">
                <div class="w-8 h-8 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center text-sm">
                    <i class="fas fa-bars"></i>
                </div>
                <h3 class="text-lg font-bold text-charcoal">Menu Admin Puskesmas</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Data Supervisor -->
                <a href="{{ route('puskesmas.supervisors.index') }}"
                    class="group bg-white rounded-[2rem] p-8 shadow-sm hover:shadow-lg border border-slate-100 hover:border-blue-300 transition-all duration-300 relative overflow-hidden flex flex-col items-start gap-4 hover:-translate-y-1">

                    <div class="w-full flex justify-between items-start mb-2">
                        <div
                            class="w-16 h-16 bg-slate-50 group-hover:bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-3xl shadow-sm transition-colors duration-300">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <span
                            class="px-4 py-1.5 bg-slate-50 border border-slate-100 text-slate-500 rounded-full font-black text-[10px] uppercase tracking-widest shadow-sm">
                            <strong class="text-blue-600 text-sm mr-1">{{ $totalSpv }}</strong> Terdaftar
                        </span>
                    </div>

                    <div>
                        <h4 class="font-black text-charcoal text-xl mb-2 group-hover:text-blue-600 transition-colors">
                            Data Supervisor</h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Kelola pendaftaran, jabatan, dan informasi
                            kontak lengkap untuk tim Supervisor Lab/Puskesmas.</p>
                    </div>

                    <div
                        class="mt-4 inline-flex items-center gap-2 text-xs font-bold text-blue-600 group-hover:translate-x-2 transition-transform">
                        Kelola Data <i class="fas fa-arrow-right"></i>
                    </div>

                    <i
                        class="fas fa-users absolute -right-6 -bottom-6 text-9xl text-slate-50 opacity-50 transform -rotate-12 group-hover:rotate-0 transition duration-700"></i>
                </a>

                <!-- Laporan BHD -->
                <a href="{{ route('puskesmas.bhd.index') }}"
                    class="group bg-white rounded-[2rem] p-8 shadow-sm hover:shadow-lg border border-slate-100 hover:border-rescue-red/30 transition-all duration-300 relative overflow-hidden flex flex-col items-start gap-4 hover:-translate-y-1">

                    <div class="w-full flex justify-between items-start mb-2">
                        <div
                            class="w-16 h-16 bg-slate-50 group-hover:bg-red-50 text-rescue-red rounded-2xl flex items-center justify-center text-3xl shadow-sm transition-colors duration-300">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <span
                            class="px-4 py-1.5 bg-slate-50 border border-slate-100 text-slate-500 rounded-full font-black text-[10px] uppercase tracking-widest shadow-sm">
                            <strong class="text-rescue-red text-sm mr-1">{{ $totalBhd }}</strong> Laporan
                        </span>
                    </div>

                    <div>
                        <h4 class="font-black text-charcoal text-xl mb-2 group-hover:text-rescue-red transition-colors">
                            Laporan BHD</h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Input riwayat pelaksanaan Bantuan Hidup Dasar
                            (BHD), kelola data peserta, dan lampirkan dokumentasi.</p>
                    </div>

                    <div
                        class="mt-4 inline-flex items-center gap-2 text-xs font-bold text-rescue-red group-hover:translate-x-2 transition-transform">
                        Lihat Laporan <i class="fas fa-arrow-right"></i>
                    </div>

                    <i
                        class="fas fa-file-medical-alt absolute -right-6 -bottom-6 text-9xl text-slate-50 opacity-50 transform -rotate-12 group-hover:rotate-0 transition duration-700"></i>
                </a>

                <!-- Tiket Bantuan & Logistik -->
                <a href="{{ route('puskesmas.requests.index') }}"
                    class="group bg-white rounded-[2rem] p-8 shadow-sm hover:shadow-lg border border-slate-100 hover:border-purple-500/30 transition-all duration-300 relative overflow-hidden flex flex-col items-start gap-4 hover:-translate-y-1">

                    <div class="w-full flex justify-between items-start mb-2">
                        <div
                            class="w-16 h-16 bg-slate-50 group-hover:bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center text-3xl shadow-sm transition-colors duration-300">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-black text-charcoal text-xl mb-2 group-hover:text-purple-600 transition-colors">
                            Pengajuan & Komplain</h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Ajukan permintaan logistik, maintenance alat
                            medis, atau komplain fasilitas ke pusat.</p>
                    </div>

                    <div
                        class="mt-4 inline-flex items-center gap-2 text-xs font-bold text-purple-600 group-hover:translate-x-2 transition-transform">
                        Buat Laporan <i class="fas fa-arrow-right"></i>
                    </div>

                    <i
                        class="fas fa-tools absolute -right-6 -bottom-6 text-9xl text-slate-50 opacity-50 transform -rotate-12 group-hover:rotate-0 transition duration-700"></i>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>