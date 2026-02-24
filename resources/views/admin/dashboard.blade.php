<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-3xl font-black text-charcoal tracking-tight">
                    WPS <span class="text-rescue-red font-semibold">Administrator</span>
                </h2>
                <p class="text-slate-500 font-medium mt-1">Pemantauan & Pengelolaan Sistem</p>
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            {{-- WELCOME MESSAGE (Clean, Glassy Card) --}}
            <div
                class="bg-gradient-to-r from-rescue-red to-red-600 rounded-[2rem] p-8 md:p-10 shadow-lg relative overflow-hidden flex items-center justify-between group">
                <div class="relative z-10 max-w-2xl">
                    <h3 class="text-2xl font-bold text-white mb-3">Selamat Datang, {{ Auth::user()->name }}</h3>
                    <p class="text-red-50 leading-relaxed">
                        Anda memiliki akses penuh untuk memantau performa sistem, mengelola pengguna, dan memastikan
                        master data (Faskes & Armada) selalu terkini.
                    </p>
                </div>
                <div
                    class="hidden md:flex relative z-10 w-24 h-24 bg-white/20 rounded-full items-center justify-center text-white text-4xl group-hover:scale-110 transition duration-500 backdrop-blur-sm shadow-inner">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <!-- Decorative subtle blur -->
                <div
                    class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full blur-3xl opacity-10 -translate-y-1/2 translate-x-1/2 pattern-grid-lg text-white">
                </div>
            </div>

            {{-- HORIZONTAL STATS RIBBON --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Total Users -->
                <div
                    class="bg-white rounded-[2rem] p-6 border border-slate-100 shadow-sm flex flex-col items-center text-center group transition hover:-translate-y-1 hover:shadow-md">
                    <div
                        class="w-14 h-14 bg-slate-50 text-slate-400 group-hover:text-blue-600 rounded-2xl flex items-center justify-center text-2xl mb-4 transition-colors">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4 class="text-4xl font-black text-charcoal mb-1">{{ $stats['total_users'] }}</h4>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Pengguna</p>
                </div>

                <!-- Emergency Calls -->
                <div
                    class="bg-white rounded-[2rem] p-6 border border-slate-100 shadow-sm flex flex-col items-center text-center group transition hover:-translate-y-1 hover:shadow-md">
                    <div
                        class="w-14 h-14 bg-red-50 text-rescue-red rounded-2xl flex items-center justify-center text-2xl mb-4 transition-colors relative">
                        <span class="absolute top-0 right-0 flex w-3 h-3 -mt-1 -mr-1">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rescue-red opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-rescue-red"></span>
                        </span>
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h4 class="text-4xl font-black text-rescue-red">{{ $stats['total_calls'] }}</h4>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Laporan</p>
                </div>

                <!-- Faskes Mitra -->
                <div
                    class="bg-white rounded-[2rem] p-6 border border-slate-100 shadow-sm flex flex-col items-center text-center group transition hover:-translate-y-1 hover:shadow-md">
                    <div
                        class="w-14 h-14 bg-slate-50 text-slate-400 group-hover:text-purple-600 rounded-2xl flex items-center justify-center text-2xl mb-4 transition-colors">
                        <i class="fas fa-hospital"></i>
                    </div>
                    <h4 class="text-4xl font-black text-charcoal mb-1">{{ $stats['hospitals'] }}</h4>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Faskes Mitra</p>
                </div>

                <!-- Armada Ready -->
                <div
                    class="bg-white rounded-[2rem] p-6 border border-slate-100 shadow-sm flex flex-col items-center text-center group transition hover:-translate-y-1 hover:shadow-md">
                    <div
                        class="w-14 h-14 bg-slate-50 text-slate-400 group-hover:text-teal-600 rounded-2xl flex items-center justify-center text-2xl mb-4 transition-colors">
                        <i class="fas fa-ambulance"></i>
                    </div>
                    <h4 class="text-4xl font-black text-charcoal mb-1">{{ $stats['total_ambulances'] }}</h4>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Armada Ready</p>
                </div>
            </div>

            {{-- MENU PENGELOLAAN --}}
            <div>
                <h3 class="text-lg font-black text-charcoal mb-5 px-1 flex items-center gap-2">
                    Menu Master & Manajemen
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                    <!-- User Management -->
                    <a href="{{ route('admin.users.index') }}"
                        class="group bg-white border border-slate-200 hover:border-blue-600 rounded-[2rem] p-6 flex flex-col gap-4 transition duration-300 hover:shadow-lg hover:shadow-blue-600/10">
                        <div
                            class="w-14 h-14 bg-slate-50 group-hover:bg-blue-50 text-slate-400 group-hover:text-blue-600 rounded-2xl flex items-center justify-center text-xl transition">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-charcoal text-sm mb-1 line-clamp-1">User Management</h4>
                            <p class="text-[11px] font-medium text-slate-400 line-clamp-2">Kelola data pengguna, role,
                                dan hak akses sistem secara global.</p>
                        </div>
                    </a>

                    <!-- Master Hospitals -->
                    <a href="{{ route('admin.hospitals.index') }}"
                        class="group bg-white border border-slate-200 hover:border-purple-600 rounded-[2rem] p-6 flex flex-col gap-4 transition duration-300 hover:shadow-lg hover:shadow-purple-600/10">
                        <div
                            class="w-14 h-14 bg-slate-50 group-hover:bg-purple-50 text-slate-400 group-hover:text-purple-600 rounded-2xl flex items-center justify-center text-xl transition">
                            <i class="fas fa-hospital-user"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-charcoal text-sm mb-1 line-clamp-1">Master Faskes & RS</h4>
                            <p class="text-[11px] font-medium text-slate-400 line-clamp-2">Database Rumah Sakit,
                                Puskesmas, dan ketersediaan IGD/Bed.</p>
                        </div>
                    </a>

                    <!-- Master Basecamps -->
                    <a href="{{ route('admin.basecamps.index') }}"
                        class="group bg-white border border-slate-200 hover:border-indigo-600 rounded-[2rem] p-6 flex flex-col gap-4 transition duration-300 hover:shadow-lg hover:shadow-indigo-600/10">
                        <div
                            class="w-14 h-14 bg-slate-50 group-hover:bg-indigo-50 text-slate-400 group-hover:text-indigo-600 rounded-2xl flex items-center justify-center text-xl transition">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-charcoal text-sm mb-1 line-clamp-1">Master Posko (Basecamp)</h4>
                            <p class="text-[11px] font-medium text-slate-400 line-clamp-2">Atur lokasi posko dan titik
                                standby ambulan layanan tanggap.</p>
                        </div>
                    </a>

                    <!-- Master Ambulances -->
                    <a href="{{ route('admin.ambulances.index') }}"
                        class="group bg-white border border-slate-200 hover:border-teal-600 rounded-[2rem] p-6 flex flex-col gap-4 transition duration-300 hover:shadow-lg hover:shadow-teal-600/10">
                        <div
                            class="w-14 h-14 bg-slate-50 group-hover:bg-teal-50 text-slate-400 group-hover:text-teal-600 rounded-2xl flex items-center justify-center text-xl transition">
                            <i class="fas fa-ambulance"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-charcoal text-sm mb-1 line-clamp-1">Master Armada Unit</h4>
                            <p class="text-[11px] font-medium text-slate-400 line-clamp-2">Data kendaraan ambulan, plat
                                nomor, dan status operasional armada.</p>
                        </div>
                    </a>

                    <!-- Command Center Shortcut -->
                    <a href="{{ route('operator.dashboard') }}"
                        class="group bg-white border border-slate-200 hover:border-amber-500 rounded-[2rem] p-6 flex flex-col gap-4 transition duration-300 hover:shadow-lg hover:shadow-amber-500/10">
                        <div
                            class="w-14 h-14 bg-slate-50 group-hover:bg-amber-50 text-slate-400 group-hover:text-amber-500 rounded-2xl flex items-center justify-center text-xl transition">
                            <i class="fas fa-satellite-dish"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-charcoal text-sm mb-1 line-clamp-1">Command Center (Operator)</h4>
                            <p class="text-[11px] font-medium text-slate-400 line-clamp-2">Pintas ke dashboard operator
                                untuk monitoring kejadian langsung.</p>
                        </div>
                    </a>

                    <!-- Audit Logs -->
                    <a href="{{ route('admin.logs.index') }}"
                        class="group bg-white border border-slate-200 hover:border-slate-800 rounded-[2rem] p-6 flex flex-col gap-4 transition duration-300 hover:shadow-lg hover:shadow-slate-800/10">
                        <div
                            class="w-14 h-14 bg-slate-50 group-hover:bg-slate-200 text-slate-400 group-hover:text-slate-800 rounded-2xl flex items-center justify-center text-xl transition">
                            <i class="fas fa-history"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-charcoal text-sm mb-1 line-clamp-1">Audit Logs & Aktivitas</h4>
                            <p class="text-[11px] font-medium text-slate-400 line-clamp-2">Rekaman rekam jejak aktivitas
                                pengguna untuk keamanan sistem.</p>
                        </div>
                    </a>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>