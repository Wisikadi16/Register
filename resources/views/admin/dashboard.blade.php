<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📊 Dashboard Administrator
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500 flex items-center justify-between">
                    <div>
                        <div class="text-gray-500 text-sm font-bold uppercase">Total Pengguna</div>
                        <div class="text-3xl font-extrabold text-gray-800 mt-1">{{ $stats['total_users'] }}</div>
                        <div class="text-xs text-gray-400 mt-1">Terdaftar di sistem</div>
                    </div>
                    <div class="text-blue-200 text-5xl">👥</div>
                </div>

                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-teal-500 flex items-center justify-between">
                    <div>
                        <div class="text-gray-500 text-sm font-bold uppercase">Driver & Nakes</div>
                        <div class="text-3xl font-extrabold text-gray-800 mt-1">{{ $stats['total_drivers'] }}</div>
                        <div class="text-xs text-gray-400 mt-1">Siap bertugas</div>
                    </div>
                    <div class="text-teal-200 text-5xl">🚑</div>
                </div>

                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-red-500 flex items-center justify-between">
                    <div>
                        <div class="text-gray-500 text-sm font-bold uppercase">Total Insiden</div>
                        <div class="text-3xl font-extrabold text-gray-800 mt-1">{{ $stats['total_calls'] }}</div>
                        <div class="text-xs text-red-500 font-bold mt-1">{{ $stats['active_calls'] }} Sedang Aktif!
                        </div>
                    </div>
                    <div class="text-red-200 text-5xl">🚨</div>
                </div>

                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-purple-500 flex items-center justify-between">
                    <div>
                        <div class="text-gray-500 text-sm font-bold uppercase">RS & Puskesmas</div>
                        <div class="text-3xl font-extrabold text-gray-800 mt-1">{{ $stats['hospitals'] }}</div>
                        <div class="text-xs text-gray-400 mt-1">Mitra rujukan</div>
                    </div>
                    <div class="text-purple-200 text-5xl">🏥</div>
                </div>

            </div>

            <h3 class="text-lg font-bold text-gray-700 mb-4">⚡ Akses Cepat (Quick Actions)</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <a href="{{ route('admin.users.index') }}"
                    class="group block bg-white hover:bg-gray-50 border border-gray-200 rounded-lg p-6 shadow-sm transition">
                    <div class="flex items-center gap-4">
                        <div
                            class="bg-blue-100 p-3 rounded-full text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Tambah User Baru</h4>
                            <p class="text-sm text-gray-500">Buat akun untuk Polisi, Damkar, atau Driver.</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('operator.dashboard') }}"
                    class="group block bg-white hover:bg-gray-50 border border-gray-200 rounded-lg p-6 shadow-sm transition">
                    <div class="flex items-center gap-4">
                        <div
                            class="bg-teal-100 p-3 rounded-full text-teal-600 group-hover:bg-teal-600 group-hover:text-white transition">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Buka Command Center</h4>
                            <p class="text-sm text-gray-500">Pantau peta kejadian dan status ambulan real-time.</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.hospitals.index') }}"
                    class="group block bg-white hover:bg-gray-50 border border-gray-200 rounded-lg p-6 shadow-sm transition">
                    <div class="flex items-center gap-4">
                        <div
                            class="bg-purple-100 p-3 rounded-full text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Kelola Data RS</h4>
                            <p class="text-sm text-gray-500">Tambah/Edit Rumah Sakit & Bed.</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.basecamps.index') }}"
                    class="group block bg-white hover:bg-gray-50 border border-gray-200 rounded-lg p-6 shadow-sm transition">
                    <div class="flex items-center gap-4">
                        <div
                            class="bg-indigo-100 p-3 rounded-full text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Kelola Puskesmas</h4>
                            <p class="text-sm text-gray-500">Tambah/Edit Data Basecamp Ambulan.</p>
                        </div>
                    </div>
                </a>

            </div>

        </div>
    </div>
</x-app-layout>