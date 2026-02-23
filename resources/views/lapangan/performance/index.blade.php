<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <a href="{{ route('lapangan.dashboard') }}"
                class="inline-flex items-center text-slate-500 hover:text-blue-600 font-bold mb-6 transition">
                <i class="fas fa-arrow-left mr-2"></i> Dashboard
            </a>

            <div class="mb-8">
                <h2 class="text-3xl font-black text-gray-800">⏱️ Respon Time & Kinerja</h2>
                <p class="text-slate-500">Statistik pelayanan tim ambulan Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Total Calls -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex items-center gap-4">
                    <div
                        class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl">
                        <i class="fas fa-route"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-400">Total Misi Selesai</p>
                        <h3 class="text-3xl font-black text-gray-800">{{ $totalCalls }}</h3>
                    </div>
                </div>

                <!-- Avg Response Time (Dummy Data for now) -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex items-center gap-4">
                    <div
                        class="w-16 h-16 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center text-2xl">
                        <i class="fas fa-stopwatch"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-400">Rata-rata Respon</p>
                        <h3 class="text-3xl font-black text-gray-800">12<span
                                class="text-lg text-slate-500 font-bold ml-1">menit</span></h3>
                    </div>
                </div>

                <!-- Rating (Dummy) -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex items-center gap-4">
                    <div
                        class="w-16 h-16 bg-yellow-50 text-yellow-600 rounded-2xl flex items-center justify-center text-2xl">
                        <i class="fas fa-star"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-400">Rating Kepuasan</p>
                        <h3 class="text-3xl font-black text-gray-800">4.8<span
                                class="text-lg text-slate-500 font-bold ml-1">/5</span></h3>
                    </div>
                </div>
            </div>

            <!-- Placeholder Graph -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 text-center">
                <div class="h-64 flex flex-col items-center justify-center text-slate-300">
                    <i class="fas fa-chart-line text-6xl mb-4"></i>
                    <p class="font-bold">Grafik Kinerja Mingguan akan ditampilkan di sini.</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>