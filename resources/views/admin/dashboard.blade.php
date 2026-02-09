<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Section -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
                <div>
                    <h2 class="text-3xl font-black text-gray-800">
                        <span class="text-indigo-600">Dashboard</span> Super Admin
                    </h2>
                    <p class="text-gray-500 mt-1">Overview statistik dan operasional sistem SOS Warga.</p>
                </div>
                <div class="bg-white px-4 py-2 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-3">
                    <div class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <div class="text-sm font-bold text-gray-700">
                        {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <!-- Total Users -->
                <div
                    class="bg-white rounded-[2rem] p-6 shadow-sm hover:shadow-lg transition duration-300 border border-gray-100 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">Total Pengguna</p>
                            <h4 class="text-4xl font-black text-gray-800 mt-2 group-hover:text-blue-600 transition">
                                {{ $stats['total_users'] }}
                            </h4>
                            <p class="text-xs text-gray-500 mt-1 font-medium">Akun Terdaftar</p>
                        </div>
                        <div
                            class="p-4 bg-blue-50 rounded-[1.5rem] text-blue-600 group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Emergency Calls -->
                <div
                    class="bg-white rounded-[2rem] p-6 shadow-sm hover:shadow-lg transition duration-300 border border-gray-100 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">Emergency Call</p>
                            <h4 class="text-4xl font-black text-gray-800 mt-2 group-hover:text-red-600 transition">
                                {{ $stats['total_calls'] }}
                            </h4>
                            <div class="mt-2 flex items-center gap-2">
                                <span class="relative flex h-3 w-3">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                                </span>
                                <p class="text-xs text-red-500 font-bold">
                                    {{ $stats['active_calls'] }} Sedang Aktif
                                </p>
                            </div>
                        </div>
                        <div
                            class="p-4 bg-red-50 rounded-[1.5rem] text-red-600 group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Faskes Mitra -->
                <div
                    class="bg-white rounded-[2rem] p-6 shadow-sm hover:shadow-lg transition duration-300 border border-gray-100 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">Faskes Mitra</p>
                            <h4 class="text-4xl font-black text-gray-800 mt-2 group-hover:text-purple-600 transition">
                                {{ $stats['hospitals'] }}
                            </h4>
                            <p class="text-xs text-gray-500 mt-1 font-medium">RS & Puskesmas</p>
                        </div>
                        <div
                            class="p-4 bg-purple-50 rounded-[1.5rem] text-purple-600 group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Armada -->
                <div
                    class="bg-white rounded-[2rem] p-6 shadow-sm hover:shadow-lg transition duration-300 border border-gray-100 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">Armada Ready</p>
                            <h4 class="text-4xl font-black text-gray-800 mt-2 group-hover:text-teal-600 transition">
                                {{ $stats['total_ambulances'] }}
                            </h4>
                            <p class="text-xs text-gray-500 mt-1 font-medium">Unit Ambulan</p>
                        </div>
                        <div
                            class="p-4 bg-teal-50 rounded-[1.5rem] text-teal-600 group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Menu Section -->
            <div class="mb-8 pl-2">
                <h3 class="text-xl font-bold text-gray-800 flex items-center gap-3">
                    <span class="w-1.5 h-8 bg-indigo-600 rounded-full inline-block"></span>
                    Menu Pengelolaan Utama
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">

                <!-- User Management -->
                <a href="{{ route('admin.users.index') }}"
                    class="group relative bg-white rounded-[2.5rem] p-8 shadow-sm hover:shadow-2xl transition-all duration-300 border border-gray-100 overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-[100%] transition-all group-hover:scale-150 duration-500">
                    </div>

                    <div class="relative z-10">
                        <div
                            class="w-16 h-16 bg-blue-100 rounded-3xl flex items-center justify-center text-blue-600 mb-6 shadow-sm group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="text-2xl font-bold text-gray-800 mb-2 group-hover:text-blue-600 transition">User
                            Management</h4>
                        <p class="text-gray-500 text-sm leading-relaxed mb-4">Kelola data pengguna, role, dan hak akses
                            sistem.</p>
                        <div
                            class="flex items-center text-blue-600 font-bold text-sm group-hover:translate-x-2 transition">
                            Kelola User <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Master Hospitals -->
                <a href="{{ route('admin.hospitals.index') }}"
                    class="group relative bg-white rounded-[2.5rem] p-8 shadow-sm hover:shadow-2xl transition-all duration-300 border border-gray-100 overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-purple-50 rounded-bl-[100%] transition-all group-hover:scale-150 duration-500">
                    </div>

                    <div class="relative z-10">
                        <div
                            class="w-16 h-16 bg-purple-100 rounded-3xl flex items-center justify-center text-purple-600 mb-6 shadow-sm group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        <h4 class="text-2xl font-bold text-gray-800 mb-2 group-hover:text-purple-600 transition">Master
                            Data: RS</h4>
                        <p class="text-gray-500 text-sm leading-relaxed mb-4">Database Rumah Sakit, Puskesmas, dan
                            fasilitas kesehatan.</p>
                        <div
                            class="flex items-center text-purple-600 font-bold text-sm group-hover:translate-x-2 transition">
                            Kelola RS <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Master Basecamps -->
                <a href="{{ route('admin.basecamps.index') }}"
                    class="group relative bg-white rounded-[2.5rem] p-8 shadow-sm hover:shadow-2xl transition-all duration-300 border border-gray-100 overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 rounded-bl-[100%] transition-all group-hover:scale-150 duration-500">
                    </div>

                    <div class="relative z-10">
                        <div
                            class="w-16 h-16 bg-indigo-100 rounded-3xl flex items-center justify-center text-indigo-600 mb-6 shadow-sm group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-2xl font-bold text-gray-800 mb-2 group-hover:text-indigo-600 transition">
                            Basecamps</h4>
                        <p class="text-gray-500 text-sm leading-relaxed mb-4">Lokasi posko dan titik standby ambulan.
                        </p>
                        <div
                            class="flex items-center text-indigo-600 font-bold text-sm group-hover:translate-x-2 transition">
                            Kelola Posko <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Master Ambulances -->
                <a href="{{ route('admin.ambulances.index') }}"
                    class="group relative bg-white rounded-[2.5rem] p-8 shadow-sm hover:shadow-2xl transition-all duration-300 border border-gray-100 overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-green-50 rounded-bl-[100%] transition-all group-hover:scale-150 duration-500">
                    </div>

                    <div class="relative z-10">
                        <div
                            class="w-16 h-16 bg-green-100 rounded-3xl flex items-center justify-center text-green-600 mb-6 shadow-sm group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h4 class="text-2xl font-bold text-gray-800 mb-2 group-hover:text-green-600 transition">Master
                            Data: Ambulan</h4>
                        <p class="text-gray-500 text-sm leading-relaxed mb-4">Data kendaraan, plat nomor, status
                            operasional.</p>
                        <div
                            class="flex items-center text-green-600 font-bold text-sm group-hover:translate-x-2 transition">
                            Kelola Ambulan <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Command Center -->
                <a href="{{ route('operator.dashboard') }}"
                    class="group relative bg-white rounded-[2.5rem] p-8 shadow-sm hover:shadow-2xl transition-all duration-300 border border-gray-100 overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-teal-50 rounded-bl-[100%] transition-all group-hover:scale-150 duration-500">
                    </div>

                    <div class="relative z-10">
                        <div
                            class="w-16 h-16 bg-teal-100 rounded-3xl flex items-center justify-center text-teal-600 mb-6 shadow-sm group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="text-2xl font-bold text-gray-800 mb-2 group-hover:text-teal-600 transition">Command
                            Center</h4>
                        <p class="text-gray-500 text-sm leading-relaxed mb-4">Akses dashboard operator untuk monitoring
                            kejadian.</p>
                        <div
                            class="flex items-center text-teal-600 font-bold text-sm group-hover:translate-x-2 transition">
                            Buka Dashboard <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Audit Logs -->
                <a href="{{ route('admin.logs.index') }}"
                    class="group relative bg-white rounded-[2.5rem] p-8 shadow-sm hover:shadow-2xl transition-all duration-300 border border-gray-100 overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-gray-100 rounded-bl-[100%] transition-all group-hover:scale-150 duration-500">
                    </div>

                    <div class="relative z-10">
                        <div
                            class="w-16 h-16 bg-gray-200 rounded-3xl flex items-center justify-center text-gray-600 mb-6 shadow-sm group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="text-2xl font-bold text-gray-800 mb-2 group-hover:text-gray-600 transition">Audit
                            Logs</h4>
                        <p class="text-gray-500 text-sm leading-relaxed mb-4">Rekaman aktivitas pengguna untuk keamanan
                            dan audit.</p>
                        <div
                            class="flex items-center text-gray-600 font-bold text-sm group-hover:translate-x-2 transition">
                            Lihat Log <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>