<x-app-layout>
    <div class="py-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('lab-medik.dashboard') }}"
                class="w-10 h-10 bg-white border border-slate-200 rounded-full flex items-center justify-center text-slate-500 hover:bg-slate-50 hover:text-charcoal transition-colors shadow-sm">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="text-2xl font-black text-charcoal mb-1">Input Data Pasien Lab</h2>
                <p class="text-sm text-slate-500 font-medium">Lengkapi form di bawah ini dengan data pasien yang valid.
                </p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="h-2 bg-gradient-to-r from-rescue-red to-red-800"></div>
            <div class="p-6 md:p-8">
                <form action="{{ route('lab-medik.patients.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Pasien -->
                        <div class="space-y-1">
                            <label class="text-sm font-bold text-slate-700">Nama Lengkap Pasien <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" required value="{{ old('name') }}"
                                class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm px-4 py-2.5"
                                placeholder="Contoh: Budi Santoso">
                        </div>

                        <!-- NIK -->
                        <div class="space-y-1">
                            <label class="text-sm font-bold text-slate-700">NIK (Nomor Induk Kependudukan)</label>
                            <input type="number" name="nik" value="{{ old('nik') }}"
                                class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm px-4 py-2.5"
                                placeholder="16 digit angka (opsional)">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Umur -->
                        <div class="space-y-1">
                            <label class="text-sm font-bold text-slate-700">Usia <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="number" name="age" required value="{{ old('age') }}" min="0" max="150"
                                    class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm px-4 py-2.5 pr-12"
                                    placeholder="0">
                                <span class="absolute right-4 top-2.5 text-slate-400 font-bold text-sm">Tahun</span>
                            </div>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="space-y-1">
                            <label class="text-sm font-bold text-slate-700">Jenis Kelamin <span
                                    class="text-red-500">*</span></label>
                            <select name="gender" required
                                class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm px-4 py-2.5">
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                </option>
                                <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="space-y-1">
                        <label class="text-sm font-bold text-slate-700">Alamat Tempat Tinggal</label>
                        <textarea name="address" rows="3"
                            class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm px-4 py-2.5 leading-relaxed"
                            placeholder="Alamat lengkap RT/RW, Kecamatan, dll (opsional)">{{ old('address') }}</textarea>
                    </div>

                    <hr class="border-slate-100">

                    <!-- Data Rekam Lab -->
                    <div class="space-y-1">
                        <label class="text-sm font-bold text-slate-700">Jenis Pemeriksaan/Tes Lab <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="test_type" required value="{{ old('test_type') }}"
                            class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm px-4 py-2.5"
                            placeholder="Contoh: Cek Darah Lengkap, Tes Urine, PCR, dsb.">
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-bold text-slate-700">Hasil Pemeriksaan/Keterangan Penunjang</label>
                        <textarea name="result" rows="4"
                            class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm px-4 py-2.5 leading-relaxed"
                            placeholder="Tuliskan hasil parameter lab atau diagnosa sementara di sini (boleh dikosongkan jika masih menunggu hasil)"></textarea>
                    </div>

                    <div class="pt-6 border-t border-slate-100">
                        <div class="flex items-center gap-4">
                            <button type="submit"
                                class="w-full sm:w-auto px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-md shadow-blue-500/30 transition-all transform hover:-translate-y-0.5">
                                <i class="fas fa-save mr-2"></i> Simpan Data Pasien
                            </button>
                            <a href="{{ route('lab-medik.dashboard') }}"
                                class="text-slate-500 hover:text-slate-700 font-bold text-sm px-4">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>