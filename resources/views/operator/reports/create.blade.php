<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen font-sans">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <a href="{{ route('operator.reports.index') }}"
                class="inline-flex items-center text-slate-500 hover:text-rescue-red font-bold mb-8 transition gap-2">
                <i class="fas fa-arrow-left"></i> Kembali ke Rekap
            </a>

            <div
                class="bg-white p-12 lg:p-14 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-slate-50 rounded-bl-[100px] z-0"></div>

                <div class="relative z-10 mb-10">
                    <h3 class="text-3xl font-black text-charcoal mb-2">Input Laporan</h3>
                    <p class="text-slate-500">Sinkronisasi data panggilan dan pasien yang masuk dari luar sistem.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-8 bg-red-50 border border-red-200 text-red-600 px-6 py-4 rounded-2xl">
                        <ul class="list-disc list-inside text-sm font-medium">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('operator.reports.store') }}" method="POST" class="space-y-8 relative z-10">
                    @csrf

                    <!-- Data Pelapor (Who called) -->
                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                        <h4 class="font-bold text-charcoal mb-6 border-b border-slate-200 pb-2"><i
                                class="fas fa-phone-alt mr-2 text-slate-400"></i> Data Pelapor</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Pelapor <span
                                        class="text-rescue-red">*</span></label>
                                <input type="text" name="caller_name" required value="{{ old('caller_name') }}"
                                    class="w-full bg-white border-slate-200 focus:border-rescue-red focus:ring-rescue-red rounded-xl py-3 px-4 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">No. Handphone <span
                                        class="text-rescue-red">*</span></label>
                                <input type="text" name="caller_phone" required value="{{ old('caller_phone') }}"
                                    class="w-full bg-white border-slate-200 focus:border-rescue-red focus:ring-rescue-red rounded-xl py-3 px-4 transition">
                            </div>
                        </div>
                    </div>

                    <!-- Data Pasien -->
                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                        <h4 class="font-bold text-charcoal mb-6 border-b border-slate-200 pb-2"><i
                                class="fas fa-user-injured mr-2 text-slate-400"></i> Data Pasien</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Pasien <span
                                        class="text-rescue-red">*</span></label>
                                <input type="text" name="patient_name" required value="{{ old('patient_name') }}"
                                    class="w-full bg-white border-slate-200 focus:border-rescue-red focus:ring-rescue-red rounded-xl py-3 px-4 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Perkiraan Usia</label>
                                <div class="flex items-center gap-2">
                                    <input type="number" name="patient_age" value="{{ old('patient_age') }}"
                                        class="w-full bg-white border-slate-200 focus:border-rescue-red focus:ring-rescue-red rounded-xl py-3 px-4 transition">
                                    <span class="text-slate-500 font-medium">Thn</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Kondisi Medis / Keluhan
                                Primer</label>
                            <textarea name="patient_condition" rows="2"
                                class="w-full bg-white border-slate-200 focus:border-rescue-red focus:ring-rescue-red rounded-xl py-3 px-4 transition">{{ old('patient_condition') }}</textarea>
                            <p class="text-xs text-slate-400 mt-2">Contoh: Pendarahan berat, Laka lantas tidak sadarkan
                                diri, dll.</p>
                        </div>
                    </div>

                    <!-- Kejadian & Penanganan -->
                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                        <h4 class="font-bold text-charcoal mb-6 border-b border-slate-200 pb-2"><i
                                class="fas fa-ambulance mr-2 text-slate-400"></i> Kejadian & Penanganan</h4>

                        <div class="mb-6">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Lokasi Kejadian <span
                                    class="text-rescue-red">*</span></label>
                            <textarea name="location" required rows="2"
                                class="w-full bg-white border-slate-200 focus:border-rescue-red focus:ring-rescue-red rounded-xl py-3 px-4 transition">{{ old('location') }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Unit Ambulan
                                    Penjemput</label>
                                <select name="ambulance_id"
                                    class="w-full bg-white border-slate-200 focus:border-rescue-red focus:ring-rescue-red rounded-xl py-3 px-4 transition">
                                    <option value="">-- Pilih Ambulan / Non-Sistem --</option>
                                    @foreach($ambulances as $amb)
                                        <option value="{{ $amb->id }}">{{ $amb->name }} ({{ $amb->vehicle_plate }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">RS Rujukan Tujuan</label>
                                <select name="hospital_id"
                                    class="w-full bg-white border-slate-200 focus:border-rescue-red focus:ring-rescue-red rounded-xl py-3 px-4 transition">
                                    <option value="">-- Pilih Rumah Sakit --</option>
                                    @foreach($hospitals as $rs)
                                        <option value="{{ $rs->id }}">{{ $rs->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Keterangan Tambahan Kasus</label>
                            <textarea name="description" rows="2"
                                class="w-full bg-white border-slate-200 focus:border-rescue-red focus:ring-rescue-red rounded-xl py-3 px-4 transition">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-100">
                        <button type="submit"
                            class="w-full bg-rescue-red hover:bg-[#b01c30] text-white font-bold py-4 px-8 rounded-xl shadow-lg shadow-rescue-red/20 transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center gap-3 text-lg">
                            <i class="fas fa-save"></i> Simpan Data Sinkronisasi
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>