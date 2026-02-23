<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <!-- Breadcrumb / Back -->
            <a href="{{ route('atem.dashboard') }}"
                class="inline-flex items-center text-slate-500 hover:text-teal-600 font-bold mb-6 transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
            </a>

            <div class="bg-white rounded-[2rem] shadow-xl border border-slate-100 overflow-hidden">
                <div class="bg-teal-600 p-8 text-white relative overflow-hidden">
                    <div class="relative z-10">
                        <h2 class="text-2xl font-black">Input Laporan Usulan</h2>
                        <p class="text-teal-100 mt-1">Ajukan pengadaan sparepart atau alat baru.</p>
                    </div>
                    <i class="fas fa-box-open absolute right-6 bottom-[-10px] text-8xl opacity-10"></i>
                </div>

                <div class="p-8">
                    <form action="{{ route('atem.usulan.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Nama Barang -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Barang / Sparepart</label>
                            <input type="text" name="item_name" required
                                placeholder="Contoh: Baterai Defibrillator X-100"
                                class="w-full rounded-xl border-slate-200 focus:border-teal-500 focus:ring-teal-500 transition px-4 py-3 bg-slate-50 focus:bg-white">
                        </div>

                        <!-- Jumlah -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Jumlah Dibutuhkan</label>
                            <input type="number" name="quantity" required placeholder="1" min="1"
                                class="w-full rounded-xl border-slate-200 focus:border-teal-500 focus:ring-teal-500 transition px-4 py-3 bg-slate-50 focus:bg-white">
                        </div>

                        <!-- Alasan / Justifikasi -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Alasan Pengajuan</label>
                            <textarea name="reason" rows="4" required
                                placeholder="Contoh: Stok lama sudah habis masa pakai..."
                                class="w-full rounded-xl border-slate-200 focus:border-teal-500 focus:ring-teal-500 transition px-4 py-3 bg-slate-50 focus:bg-white"></textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-teal-500/30 transition transform hover:-translate-y-1 mt-6 flex items-center justify-center gap-2">
                            <i class="fas fa-paper-plane"></i> Kirim Usulan
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>