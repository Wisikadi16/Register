<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center w-full">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                <span class="text-indigo-600">Dashboard</span> Super Admin
            </h2>
            <div class="mt-2 md:mt-0 text-sm text-gray-500 text-right">
                {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <!-- Stat Card 1 -->
                <div
                    class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition duration-300 border-b-4 border-blue-500 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">Total Pengguna</p>
                            <h4 class="text-3xl font-black text-gray-800 mt-2 group-hover:text-blue-600 transition">
                                {{ $stats['total_users'] }}
                            </h4>
                            <p class="text-xs text-gray-500 mt-1">Akun Terdaftar</p>
                        </div>
                        <div
                            class="p-3 bg-blue-50 rounded-lg text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Stat Card 2 -->
                <div
                    class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition duration-300 border-b-4 border-teal-500 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">Driver & Nakes</p>
                            <h4 class="text-3xl font-black text-gray-800 mt-2 group-hover:text-teal-600 transition">
                                {{ $stats['total_drivers'] }}
                            </h4>
                            <p class="text-xs text-gray-500 mt-1">Petugas Lapangan</p>
                        </div>
                        <div
                            class="p-3 bg-teal-50 rounded-lg text-teal-600 group-hover:bg-teal-600 group-hover:text-white transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Stat Card 3 -->
                <div
                    class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition duration-300 border-b-4 border-red-500 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">Emergency Call</p>
                            <h4 class="text-3xl font-black text-gray-800 mt-2 group-hover:text-red-600 transition">
                                {{ $stats['total_calls'] }}
                            </h4>
                            <p
                                class="text-xs text-red-500 font-bold mt-1 bg-red-100 px-2 py-0.5 rounded-full inline-block animate-pulse">
                                {{ $stats['active_calls'] }} Sedang Aktif
                            </p>
                        </div>
                        <div
                            class="p-3 bg-red-50 rounded-lg text-red-600 group-hover:bg-red-600 group-hover:text-white transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Stat Card 4 -->
                <div
                    class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition duration-300 border-b-4 border-purple-500 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">Faskes Mitra</p>
                            <h4 class="text-3xl font-black text-gray-800 mt-2 group-hover:text-purple-600 transition">
                                {{ $stats['hospitals'] }}
                            </h4>
                            <p class="text-xs text-gray-500 mt-1">RS & Puskesmas</p>
                        </div>
                        <div
                            class="p-3 bg-purple-50 rounded-lg text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Section -->
            <div class="mb-6 flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                    <span class="w-1 h-8 bg-blue-600 rounded-full inline-block"></span>
                    Menu Pengelolaan Utama
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                <!-- User Mgmt -->
                <a href="{{ route('admin.users.index') }}"
                    class="group relative bg-white overflow-hidden rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="p-6">
                        <div
                            class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600 mb-4 group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-blue-600 transition">User
                            Management</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Tambah, edit, atau reset password untuk seluruh
                            pengguna sistem.</p>
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-full h-1 bg-blue-500 transform scale-x-0 group-hover:scale-x-100 transition duration-300">
                    </div>
                </a>

                <!-- Command Center -->
                <a href="{{ route('operator.dashboard') }}"
                    class="group relative bg-white overflow-hidden rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="p-6">
                        <div
                            class="w-14 h-14 bg-teal-100 rounded-2xl flex items-center justify-center text-teal-600 mb-4 group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-teal-600 transition">Command
                            Center</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Pantau peta kejadian emergency real-time dan
                            monitoring ambulan.</p>
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-full h-1 bg-teal-500 transform scale-x-0 group-hover:scale-x-100 transition duration-300">
                    </div>
                </a>

                <!-- Hospitals -->
                <a href="{{ route('admin.hospitals.index') }}"
                    class="group relative bg-white overflow-hidden rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="p-6">
                        <div
                            class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center text-purple-600 mb-4 group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-purple-600 transition">Master
                            Data: RS</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Kelola data Rumah Sakit Rujukan, update
                            kapasitas bed & lokasi.</p>
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-full h-1 bg-purple-500 transform scale-x-0 group-hover:scale-x-100 transition duration-300">
                    </div>
                </a>

                <!-- Puskesmas -->
                <a href="{{ route('admin.basecamps.index') }}"
                    class="group relative bg-white overflow-hidden rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="p-6">
                        <div
                            class="w-14 h-14 bg-indigo-100 rounded-2xl flex items-center justify-center text-indigo-600 mb-4 group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-indigo-600 transition">Master
                            Data: Puskesmas</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Kelola titik lokasi standby ambulan
                            (Basecamp/Posko).</p>
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-full h-1 bg-indigo-500 transform scale-x-0 group-hover:scale-x-100 transition duration-300">
                    </div>
                </a>

                <!-- Ambulances -->
                <a href="{{ route('admin.ambulances.index') }}"
                    class="group relative bg-white overflow-hidden rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="p-6">
                        <div
                            class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center text-green-600 mb-4 group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-green-600 transition">Master
                            Data: Ambulan</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Kelola unit kendaraan, plat nomor, status
                            ready, dan driver.</p>
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-full h-1 bg-green-500 transform scale-x-0 group-hover:scale-x-100 transition duration-300">
                    </div>
                </a>

                <!-- Audit Log -->
                <a href="{{ route('admin.logs.index') }}"
                    class="group relative bg-white overflow-hidden rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="p-6">
                        <div
                            class="w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center text-gray-600 mb-4 group-hover:scale-110 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-gray-600 transition">Audit Log
                            System</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Rekaman jejak aktivitas pengguna untuk keamanan
                            & audit.</p>
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-full h-1 bg-gray-500 transform scale-x-0 group-hover:scale-x-100 transition duration-300">
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>