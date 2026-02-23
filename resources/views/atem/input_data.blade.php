<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <!-- Breadcrumb / Back -->
            <a href="{{ route('atem.dashboard') }}"
                class="inline-flex items-center text-slate-500 hover:text-blue-600 font-bold mb-6 transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
            </a>

            <div class="bg-white rounded-[2rem] shadow-xl border border-slate-100 overflow-hidden">
                <div class="bg-blue-600 p-8 text-white relative overflow-hidden">
                    <div class="relative z-10">
                        <h2 class="text-2xl font-black">Input Data Pemeliharaan</h2>
                        <p class="text-blue-100 mt-1">Isi formulir pengecekan alat di bawah ini.</p>
                    </div>
                    <i class="fas fa-notes-medical absolute right-6 bottom-[-10px] text-8xl opacity-10"></i>
                </div>

                <div class="p-8">
                    <form action="{{ route('atem.data.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Pilih Alat (Dari Inventory Medis) -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Alat / Aset</label>
                            <div class="relative">
                                <select name="inventory_id" required
                                    class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition px-4 py-3 bg-slate-50 focus:bg-white appearance-none">
                                    <option value="" disabled selected>-- Pilih Alat --</option>
                                    @foreach($tools as $tool)
                                        <option value="{{ $tool->id }}">{{ $tool->name }} (Stok: {{ $tool->quantity }})
                                        </option>
                                    @endforeach
                                </select>
                                <div
                                    class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-500">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Tanggal Pengecekan -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Pengecekan</label>
                            <input type="date" name="maintenance_date" value="{{ date('Y-m-d') }}" required
                                class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition px-4 py-3 bg-slate-50 focus:bg-white">
                        </div>

                        <!-- Deskripsi Kondisi -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi Kondisi /
                                Masalah</label>
                            <textarea name="description" rows="3" required
                                placeholder="Contoh: Sensor oksigen tidak responsif..."
                                class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition px-4 py-3 bg-slate-50 focus:bg-white"></textarea>
                        </div>

                        <!-- Catatan Teknisi -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Tindakan / Catatan
                                Teknisi</label>
                            <textarea name="technician_note" rows="3" placeholder="Contoh: Dilakukan kalibrasi ulang..."
                                class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition px-4 py-3 bg-slate-50 focus:bg-white"></textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-blue-500/30 transition transform hover:-translate-y-1 mt-6 flex items-center justify-center gap-2">
                            <i class="fas fa-save"></i> Simpan Data
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>