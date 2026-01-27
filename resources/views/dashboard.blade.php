<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Overview') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto space-y-6">

            <!-- Welcome Banner -->
            <div
                class="bg-gradient-to-r from-pusaka to-teal-500 rounded-2xl shadow-lg p-8 text-white relative overflow-hidden">
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">Halo, {{ Auth::user()->name }}! 👋</h1>
                        <p class="text-teal-100 text-lg">Bagaimana kondisi kesehatan Anda hari ini?</p>
                        <div class="mt-6 flex gap-3">
                            <a href="{{ route('emergency.create') }}"
                                class="bg-white text-teal-600 px-6 py-3 rounded-xl font-bold hover:bg-teal-50 transition shadow-md flex items-center">
                                <span class="mr-2">🚑</span> Panggil Ambulan
                            </a>
                            <button
                                class="bg-teal-700/50 hover:bg-teal-700/70 text-white px-6 py-3 rounded-xl font-semibold transition backdrop-blur-sm">
                                Cek Kesehatan
                            </button>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <!-- Illustration Placeholder -->
                        <span class="text-9xl opacity-20">🏥</span>
                    </div>
                </div>
                <!-- Decor -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-16 -mt-16"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-black opacity-5 rounded-full -ml-8 -mb-8"></div>
            </div>

            <!-- Stats / Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1: Emergency Status -->
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center text-xl text-red-600">
                            🆘
                        </div>
                        <span class="text-sm font-semibold text-gray-400">Status Darurat</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-1">Siaga</h3>
                    <p class="text-sm text-gray-500">Tidak ada panggilan aktif saat ini.</p>
                </div>

                <!-- Card 2: Nearby Hospitals -->
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-xl text-blue-600">
                            🏥
                        </div>
                        <span class="text-sm font-semibold text-gray-400">Faskes Terdekat</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-1">3 RS Siaga</h3>
                    <p class="text-sm text-gray-500">RSUD Banyumas, RS Hermina...</p>
                </div>

                <!-- Card 3: Health Profile -->
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center text-xl text-teal-600">
                            🩺
                        </div>
                        <span class="text-sm font-semibold text-gray-400">Profil Medis</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-1">Lengkap</h3>
                    <p class="text-sm text-gray-500">Data golongan darah & riwayat.</p>
                </div>
            </div>

            <!-- Recent Activity Table (Placeholder) -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                    <h3 class="font-bold text-lg text-gray-800 dark:text-white">Riwayat Panggilan</h3>
                    <a href="#" class="text-teal-600 text-sm font-semibold hover:underline">Lihat Semua ></a>
                </div>
                <div class="p-6 text-center text-gray-400 py-12">
                    Belum ada riwayat panggilan darurat.
                </div>
            </div>

        </div>
    </div>
</x-app-layout>