<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Panduan Pertolongan Pertama (P3K)') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ active: null }">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Intro Card --}}
            <div
                class="bg-gradient-to-r from-yellow-500 to-orange-500 rounded-2xl shadow-lg p-8 text-white mb-8 relative overflow-hidden">
                <div class="relative z-10">
                    <h1 class="text-3xl font-bold mb-2">Jangan Panik!</h1>
                    <p class="text-yellow-50 text-lg">Panduan singkat ini dapat membantu Anda memberikan pertolongan
                        pertama sementara menunggu bantuan medis tiba.</p>
                </div>
                <i class="fas fa-book-medical absolute -right-4 -bottom-4 text-9xl text-white opacity-20 rotate-12"></i>
            </div>

            {{-- 1. Luka Bakar --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                <button @click="active === 1 ? active = null : active = 1"
                    class="w-full flex items-center justify-between p-6 text-left">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center text-red-600 text-xl">
                            🔥</div>
                        <h3 class="font-bold text-lg text-gray-800 dark:text-white">Luka Bakar Ringan</h3>
                    </div>
                    <i class="fas fa-chevron-down text-gray-400 transition transform"
                        :class="{'rotate-180': active === 1}"></i>
                </button>
                <div x-show="active === 1" x-collapse class="px-6 pb-6 text-gray-600 dark:text-gray-300 space-y-2">
                    <p>1. <b>Dinginkan</b> area luka dengan air mengalir (bukan air es) selama 10-20 menit.</p>
                    <p>2. <b>Lepaskan</b> aksesoris (cincin/jam) sebelum area membengkak.</p>
                    <p>3. <b>Tutup</b> luka dengan kassa steril atau kain bersih yang tidak berserat.</p>
                    <div class="bg-red-50 p-3 rounded-lg text-red-700 text-sm mt-2 font-semibold">
                        ⚠️ JANGAN mengoleskan pasta gigi, mentega, atau memecahkan gelembung luka.
                    </div>
                </div>
            </div>

            {{-- 2. Patah Tulang --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                <button @click="active === 2 ? active = null : active = 2"
                    class="w-full flex items-center justify-between p-6 text-left">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-xl">
                            🦴</div>
                        <h3 class="font-bold text-lg text-gray-800 dark:text-white">Dugaan Patah Tulang</h3>
                    </div>
                    <i class="fas fa-chevron-down text-gray-400 transition transform"
                        :class="{'rotate-180': active === 2}"></i>
                </button>
                <div x-show="active === 2" x-collapse class="px-6 pb-6 text-gray-600 dark:text-gray-300 space-y-2">
                    <p>1. <b>Jangan gerakkan</b> bagian yang cedera kecuali terpaksa untuk keamanan.</p>
                    <p>2. <b>Pasang bidai</b> (penyangga) menggunakan karton atau kayu yang dibalut kain lembut.</p>
                    <p>3. <b>Kompres dingin</b> area yang bengkak (bungkus es dengan kain, jangan tempel langsung ke
                        kulit).</p>
                </div>
            </div>

            {{-- 3. Tersedak --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                <button @click="active === 3 ? active = null : active = 3"
                    class="w-full flex items-center justify-between p-6 text-left">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 text-xl">
                            🤢</div>
                        <h3 class="font-bold text-lg text-gray-800 dark:text-white">Tersedak (Heimlich Maneuver)</h3>
                    </div>
                    <i class="fas fa-chevron-down text-gray-400 transition transform"
                        :class="{'rotate-180': active === 3}"></i>
                </button>
                <div x-show="active === 3" x-collapse class="px-6 pb-6 text-gray-600 dark:text-gray-300 space-y-2">
                    <p>1. Berdiri di belakang korban, lingkarkan lengan di pinggangnya.</p>
                    <p>2. Kepalkan satu tangan di atas pusar, genggam dengan tangan lainnya.</p>
                    <p>3. Tekan ke dalam dan ke atas dengan kuat dan cepat.</p>
                    <p>4. Ulangi sampai benda asing keluar.</p>
                </div>
            </div>

            {{-- Disclaimer --}}
            <div class="text-center text-xs text-gray-400 mt-8">
                Informasi ini hanya panduan awal. Tetap hubungi tenaga medis untuk penanganan lebih lanjut.
            </div>

        </div>
    </div>
</x-app-layout>