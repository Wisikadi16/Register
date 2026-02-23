<x-app-layout>
    <div class="min-h-screen bg-slate-50 relative overflow-hidden">
        <!-- Background Decoration -->
        <div
            class="absolute top-0 left-0 w-full h-96 bg-gradient-to-br from-teal-500 to-blue-600 rounded-b-[3rem] shadow-lg">
        </div>
        <div class="absolute top-10 right-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute top-20 left-20 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Header Section -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-12">
                <div class="text-white">
                    <h2 class="text-4xl font-black tracking-tight mb-2 text-shadow-sm">Lab Puskesmas</h2>
                    <p class="text-blue-100 text-lg font-medium">Sistem Informasi Manajemen Data & Pelaporan</p>
                </div>
                <div
                    class="mt-6 md:mt-0 flex items-center bg-white/20 backdrop-blur-md px-6 py-3 rounded-2xl border border-white/20 shadow-lg">
                    <div class="p-2 bg-white rounded-xl text-teal-600 mr-4 shadow-sm">
                        <i class="fas fa-hospital-user text-xl"></i>
                    </div>
                    <div>
                        <div class="text-xs text-blue-100 uppercase font-bold tracking-wider">User Login</div>
                        <div class="text-white font-bold text-lg">{{ Auth::user()->name }}</div>
                    </div>
                </div>
            </div>

            <!-- Stats & Menu Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Menu 1: Data Supervisor -->
                <a href="{{ route('puskesmas.supervisors.index') }}"
                    class="group relative bg-white rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-blue-500/20 hover:-translate-y-2 transition-all duration-300 border border-slate-100 overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-[100%] transition-transform group-hover:scale-110">
                    </div>

                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div>
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-blue-100 to-blue-50 text-blue-600 rounded-3xl flex items-center justify-center text-4xl mb-6 shadow-inner group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <h3
                                class="text-2xl font-black text-slate-800 mb-2 group-hover:text-blue-600 transition-colors">
                                Data Supervisor</h3>
                            <p class="text-slate-500 leading-relaxed">Kelola data personil supervisor, jabatan, dan
                                informasi kontak tim Lab Puskesmas.</p>
                        </div>

                        <div class="mt-8 flex items-center justify-between">
                            <span class="px-5 py-2 bg-blue-50 text-blue-600 rounded-xl font-bold text-sm">
                                {{ $totalSpv }} Terdaftar
                            </span>
                            <div
                                class="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center shadow-lg group-hover:bg-blue-700 transition relative overflow-hidden">
                                <i class="fas fa-arrow-right relative z-10"></i>
                                <div
                                    class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Menu 2: Laporan BHD -->
                <a href="{{ route('puskesmas.bhd.index') }}"
                    class="group relative bg-white rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-rose-500/20 hover:-translate-y-2 transition-all duration-300 border border-slate-100 overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-rose-50 rounded-bl-[100%] transition-transform group-hover:scale-110">
                    </div>

                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div>
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-rose-100 to-rose-50 text-rose-600 rounded-3xl flex items-center justify-center text-4xl mb-6 shadow-inner group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-heartbeat"></i>
                            </div>
                            <h3
                                class="text-2xl font-black text-slate-800 mb-2 group-hover:text-rose-600 transition-colors">
                                Laporan BHD</h3>
                            <p class="text-slate-500 leading-relaxed">Input dan monitoring laporan kegiatan Bantuan
                                Hidup Dasar (BHD) serta dokumentasi.</p>
                        </div>

                        <div class="mt-8 flex items-center justify-between">
                            <span class="px-5 py-2 bg-rose-50 text-rose-600 rounded-xl font-bold text-sm">
                                {{ $totalBhd }} Laporan
                            </span>
                            <div
                                class="w-12 h-12 rounded-full bg-rose-600 text-white flex items-center justify-center shadow-lg group-hover:bg-rose-700 transition relative overflow-hidden">
                                <i class="fas fa-arrow-right relative z-10"></i>
                                <div
                                    class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>

            <!-- Quick Footer Info -->
            <div class="mt-12 text-center">
                <p class="text-sm font-medium text-slate-400">
                    &copy; {{ date('Y') }} Sistem Ambulan Hebat & Lab Medis. All rights reserved.
                </p>
            </div>

        </div>
    </div>
</x-app-layout>