<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="mb-4">
                <h2 class="text-3xl font-black text-gray-800">
                    Input <span class="text-teal-600">Data Pasien</span>
                </h2>
            </div>

            <div class="flex justify-between items-center bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                <div>
                    <h3 class="text-xl font-black text-slate-800">Formulir Rekam Medis (Nakes)</h3>
                    <p class="text-slate-500 text-sm">Harap isi data vital sign dan kondisi pasien dengan akurat.</p>
                </div>
                <a href="{{ route('nakes.dashboard') }}"
                    class="px-5 py-2.5 bg-slate-100 text-slate-600 font-bold rounded-xl hover:bg-slate-200 transition">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>

            <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
                <form action="{{ route('nakes.patients.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Pasien</label>
                            <input type="text" name="nama"
                                class="w-full rounded-xl border-slate-200 focus:border-teal-500 focus:ring-teal-500 bg-slate-50 py-3"
                                placeholder="Masukkan nama pasien...">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">NIK / No. Identitas</label>
                            <input type="number" name="nik"
                                class="w-full rounded-xl border-slate-200 focus:border-teal-500 focus:ring-teal-500 bg-slate-50 py-3"
                                placeholder="Masukkan NIK...">
                        </div>
                    </div>

                    <h4 class="font-bold text-slate-800 mb-4 border-b pb-2"><i
                            class="fas fa-heartbeat text-teal-500 mr-2"></i> Tanda Vital (Vital Signs)</h4>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Tensi
                                (mmHg)</label>
                            <input type="text" name="tensi" placeholder="120/80"
                                class="w-full rounded-xl border-slate-200 focus:border-teal-500 focus:ring-teal-500 text-center font-mono">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Nadi
                                (bpm)</label>
                            <input type="number" name="nadi" placeholder="80"
                                class="w-full rounded-xl border-slate-200 focus:border-teal-500 focus:ring-teal-500 text-center font-mono">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Suhu
                                (°C)</label>
                            <input type="number" step="0.1" name="suhu" placeholder="36.5"
                                class="w-full rounded-xl border-slate-200 focus:border-teal-500 focus:ring-teal-500 text-center font-mono">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Nafas
                                (x/m)</label>
                            <input type="number" name="nafas" placeholder="20"
                                class="w-full rounded-xl border-slate-200 focus:border-teal-500 focus:ring-teal-500 text-center font-mono">
                        </div>
                    </div>

                    <h4 class="font-bold text-slate-800 mb-4 border-b pb-2"><i
                            class="fas fa-notes-medical text-teal-500 mr-2"></i> Diagnosis & Tindakan</h4>
                    <div class="space-y-4 mb-8">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Diagnosis Awal</label>
                            <textarea name="diagnosis" rows="3"
                                class="w-full rounded-xl border-slate-200 focus:border-teal-500 focus:ring-teal-500 bg-slate-50"
                                placeholder="Jelaskan kondisi pasien saat ditangani..."></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Tindakan Medis yang
                                Diberikan</label>
                            <textarea name="tindakan" rows="3"
                                class="w-full rounded-xl border-slate-200 focus:border-teal-500 focus:ring-teal-500 bg-slate-50"
                                placeholder="Tindakan yang telah dilakukan Nakes/Driver..."></textarea>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                        <button type="submit"
                            class="px-8 py-3 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl shadow-lg shadow-teal-500/30 transition-all transform hover:scale-105 active:scale-95">
                            <i class="fas fa-save mr-2"></i> Simpan Data Pasien
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>