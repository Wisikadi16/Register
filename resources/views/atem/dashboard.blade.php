<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Welcome Header -->
            <div
                class="bg-gradient-to-r from-blue-600 to-cyan-500 rounded-3xl p-10 text-white shadow-xl relative overflow-hidden">
                <div class="relative z-10">
                    <h1 class="text-4xl font-black mb-2 tracking-tight">Halo, Teknisi {{ Auth::user()->name }}! 👋</h1>
                    <p class="text-blue-100 text-lg opacity-90">Selamat datang di Panel ATEM. Silakan pilih menu
                        operasional di bawah ini.</p>
                </div>
                <div class="absolute right-0 bottom-0 opacity-10 transform translate-x-10 translate-y-10">
                    <i class="fas fa-tools text-[12rem]"></i>
                </div>
            </div>

            <!-- Menu Grid (2 Buttons Sesuai Flowchart) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Menu 1: Input Data (Pemeliharaan) -->
                <a href="{{ route('atem.data') }}"
                    class="group bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 hover:shadow-2xl hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-10 transition duration-500 transform group-hover:scale-110">
                        <i class="fas fa-clipboard-check text-9xl text-blue-600"></i>
                    </div>
                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div
                            class="w-20 h-20 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 text-4xl mb-6 group-hover:bg-blue-600 group-hover:text-white transition duration-300 shadow-sm">
                            <i class="fas fa-notes-medical"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-black text-slate-800 mb-2 group-hover:text-blue-600 transition">
                                Input Data Pemeliharaan</h3>
                            <p class="text-slate-500 font-medium">Catat log pengecekan alat harian atau perbaikan.</p>
                        </div>
                        <div
                            class="mt-8 flex items-center text-blue-600 font-bold group-hover:translate-x-2 transition">
                            <span>Buka Menu</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </div>
                    </div>
                </a>

                <!-- Menu 2: Input Laporan Usulan -->
                <a href="{{ route('atem.usulan') }}"
                    class="group bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 hover:shadow-2xl hover:border-teal-200 transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-10 transition duration-500 transform group-hover:scale-110">
                        <i class="fas fa-file-invoice text-9xl text-teal-600"></i>
                    </div>
                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div
                            class="w-20 h-20 bg-teal-50 rounded-2xl flex items-center justify-center text-teal-600 text-4xl mb-6 group-hover:bg-teal-600 group-hover:text-white transition duration-300 shadow-sm">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-black text-slate-800 mb-2 group-hover:text-teal-600 transition">
                                Input Laporan Usulan</h3>
                            <p class="text-slate-500 font-medium">Ajukan permintaan sparepart atau alat baru.</p>
                        </div>
                        <div
                            class="mt-8 flex items-center text-teal-600 font-bold group-hover:translate-x-2 transition">
                            <span>Buka Menu</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </div>
                    </div>
                </a>

            </div>

        </div>
    </div>
</x-app-layout>