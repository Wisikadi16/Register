<x-app-layout>
        <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            {{-- Bagian Kiri: Tombol Back & Judul --}}
            <div class="flex items-center gap-4">
                {{-- Ini adalah kode tombol kembalinya --}}
                <a href="{{ route('klinik.dashboard') }}"
                    class="bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-xl px-4 py-2 font-bold shadow-sm transition flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                
                {{-- Judul Halaman --}}
                <h2 class="text-3xl font-black text-gray-800 leading-tight border-l-2 border-gray-200 pl-4">
                    <span class="text-blue-600">Data Ambulan</span> Klinik Utama
                </h2>
            </div>

            {{-- Bagian Kanan: Breadcrumbs --}}
            <div class="text-sm font-medium text-gray-500 hidden md:block">
                <a href="{{ route('klinik.dashboard') }}" class="text-blue-600 hover:underline">Dashboard</a> <span
                    class="mx-2">/</span> Data Ambulan
            </div>
        </div>
    </x-slot>


    <div class="py-12 min-h-screen bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            @if(session('success'))
                <div
                    class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-2xl shadow-sm flex items-start gap-4 mb-6">
                    <div class="flex-shrink-0 bg-emerald-100 rounded-full p-2 text-emerald-600">
                        <i class="fas fa-check-circle text-xl"></i>
                    </div>
                    <div>
                        <p class="font-bold text-lg">Berhasil!</p>
                        <p class="text-emerald-700/80">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Form Input Data Ambulan --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden sticky top-8">
                        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                            <h3 class="font-bold text-lg text-slate-800 flex items-center gap-2">
                                <i class="fas fa-ambulance text-rose-500"></i> Pendaftaran Ambulan
                            </h3>
                        </div>
                        <div class="p-6">
                            <form action="{{ route('klinik.ambulan.store') }}" method="POST">
                                @csrf
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">Nama Panggilan
                                            Ambulan</label>
                                        <input type="text" name="name" required
                                            placeholder="Contoh: Ambulan Klinik A 01"
                                            class="w-full rounded-xl border-gray-200 focus:border-rose-500 focus:ring-rose-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">Nomor Plat
                                            (Nopol)</label>
                                        <input type="text" name="plat_number" required placeholder="Contoh: H 1234 XY"
                                            class="w-full rounded-xl border-gray-200 focus:border-rose-500 focus:ring-rose-500 uppercase">
                                    </div>
                                    <button type="submit"
                                        class="w-full bg-rose-600 hover:bg-rose-700 text-white font-bold py-3 px-4 rounded-xl transition shadow-sm flex items-center justify-center gap-2">
                                        <i class="fas fa-save"></i> Daftarkan Ambulan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Informasi Singkat --}}
                <div class="lg:col-span-2">
                    <div
                        class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden p-8 flex items-start gap-6">
                        <div
                            class="w-16 h-16 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-3xl shrink-0">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-800 mb-2">Pendaftaran Armada Ambulan</h3>
                            <p class="text-slate-600 leading-relaxed mb-4">
                                Gunakan form di samping untuk mendaftarkan ambulan yang beroperasi di bawah naungan
                                klinik utama Anda. Ambulan yang terdaftar akan dapat digunakan dan dilacak dalam sistem
                                integrasi kegawatdaruratan SPGDT.
                            </p>
                            <div class="bg-slate-50 border border-slate-100 p-4 rounded-xl">
                                <p class="text-sm font-semibold text-slate-700">
                                    <i class="fas fa-clipboard-check text-green-500 mr-2"></i> Status otomatis di set
                                    menjadi <span class="font-bold">Offline</span> saat baru didaftarkan. Anda dapat
                                    mengelolanya lebih lanjut melalui menu lain atau aplikasi driver.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>