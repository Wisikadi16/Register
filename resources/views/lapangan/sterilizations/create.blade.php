<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            <a href="{{ route('lapangan.dashboard') }}"
                class="inline-flex items-center text-slate-500 hover:text-blue-600 font-bold mb-6 transition">
                <i class="fas fa-arrow-left mr-2"></i> Batal & Kembali
            </a>

            <div
                class="bg-white rounded-[2.5rem] p-8 shadow-xl shadow-teal-500/10 border border-teal-100 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-teal-50 rounded-full -mr-10 -mt-10 blur-2xl"></div>

                <div class="relative z-10">
                    <div class="flex flex-col items-center mb-8 text-center">
                        <div
                            class="w-20 h-20 bg-teal-100 text-teal-600 rounded-3xl flex items-center justify-center mb-4 text-3xl shadow-sm">
                            <i class="fas fa-pump-soap"></i>
                        </div>
                        <h2 class="text-2xl font-black text-gray-800">Laporan Sterilisasi</h2>
                        <p class="text-slate-500">Wajib diisi setelah mengantar pasien infeksius.</p>
                    </div>

                    <form action="{{ route('lapangan.sterilizations.store') }}" method="POST"
                        enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Metode Sterilisasi</label>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="cursor-pointer">
                                    <input type="radio" name="method" value="Desinfektan Semprot" class="peer sr-only"
                                        required>
                                    <div
                                        class="p-4 rounded-xl border-2 border-slate-100 bg-white hover:border-teal-200 peer-checked:border-teal-500 peer-checked:bg-teal-50 transition text-center">
                                        <i
                                            class="fas fa-spray-can text-2xl mb-2 text-slate-400 peer-checked:text-teal-600"></i>
                                        <div class="font-bold text-sm text-slate-600 peer-checked:text-teal-800">Semprot
                                        </div>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="method" value="UV Light" class="peer sr-only">
                                    <div
                                        class="p-4 rounded-xl border-2 border-slate-100 bg-white hover:border-teal-200 peer-checked:border-teal-500 peer-checked:bg-teal-50 transition text-center">
                                        <i
                                            class="fas fa-lightbulb text-2xl mb-2 text-slate-400 peer-checked:text-teal-600"></i>
                                        <div class="font-bold text-sm text-slate-600 peer-checked:text-teal-800">Sinar
                                            UV</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Foto Bukti Pelaksanaan</label>
                            <div
                                class="relative border-2 border-dashed border-slate-300 rounded-2xl p-8 text-center hover:bg-slate-50 transition group">
                                <input type="file" name="photo_proof"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required>
                                <div class="text-slate-400 group-hover:text-teal-500">
                                    <i class="fas fa-camera text-3xl mb-2"></i>
                                    <p class="text-sm font-bold">Klik untuk ambil foto</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Catatan Tambahan</label>
                            <textarea name="notes" rows="3"
                                class="w-full rounded-xl border-gray-200 focus:ring-teal-500 focus:border-teal-500"
                                placeholder="Keterangan area yang disterilkan..."></textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-teal-600 text-white font-bold py-4 rounded-2xl hover:bg-teal-700 transition shadow-lg shadow-teal-500/30 flex items-center justify-center gap-2">
                            <i class="fas fa-paper-plane"></i> Kirim Laporan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>