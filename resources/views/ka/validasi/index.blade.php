<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('ka.dashboard') }}"
                    class="bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-xl px-4 py-2 font-bold shadow-sm transition flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <h2 class="text-3xl font-black text-gray-800 leading-tight border-l-2 border-gray-200 pl-4">
                    <span class="text-blue-600">Validasi</span> Laporan
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12 min-h-screen bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8 text-center">
                <div
                    class="text-slate-400 mb-4 inline-flex items-center justify-center w-20 h-20 bg-slate-50 rounded-full text-3xl">
                    <i class="fas fa-tools"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-700 mb-2">Halaman Validasi Laporan</h3>
                <p class="text-slate-500">Hobi dalam tahap pengembangan. Fitur persetujuan (validasi) kinerja tim akan
                    segera hadir di sini.</p>
            </div>
        </div>
    </div>
</x-app-layout>