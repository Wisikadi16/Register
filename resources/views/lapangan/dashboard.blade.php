<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="text-3xl font-black text-gray-800 leading-tight">
                Dashboard <span class="text-blue-600">Tim Lapangan</span>
            </h2>
            <div class="bg-white px-4 py-2 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-3">
                <div class="p-2 bg-blue-50 rounded-xl text-blue-600">
                    <i class="fas fa-ambulance"></i>
                </div>
                <div class="text-sm font-bold text-gray-700">
                    {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- WELCOME CARD --}}
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden relative">
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-full -mr-10 -mt-10 blur-2xl"></div>
                <div class="p-8 relative z-10">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <h3 class="text-2xl font-black text-slate-800">Halo, {{ Auth::user()->name }}! 👋</h3>
                            @if($ambulance)
                                <p class="text-slate-500 mt-1">Armada: <strong>{{ $ambulance->name }}</strong> <span
                                        class="bg-slate-100 px-2 py-0.5 rounded text-xs text-slate-600 font-mono ml-2">{{ $ambulance->plat_number }}</span>
                                </p>
                            @else
                                <p class="text-red-500 mt-1 font-bold">⚠️ Belum terhubung dengan unit ambulan.</p>
                            @endif
                        </div>

                        @if($ambulance)
                                            <div class="flex items-center gap-3">
                                                <span class="text-sm font-bold text-slate-400 uppercase tracking-wider">Status Unit</span>
                                                <span
                                                    class="px-4 py-2 rounded-xl text-sm font-bold shadow-sm border
                                                                                                                                                                                                                                                            {{ $ambulance->status == 'ready' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' :
                            ($ambulance->status == 'busy' ? 'bg-red-50 text-red-600 border-red-100' : 'bg-slate-50 text-slate-600 border-slate-100') }}">
                                                    <i
                                                        class="fas fa-circle text-[10px] mr-1.5 {{ $ambulance->status == 'ready' ? 'text-emerald-500' : ($ambulance->status == 'busy' ? 'text-red-500' : 'text-slate-400') }}"></i>
                                                    {{ strtoupper($ambulance->status) }}
                                                </span>
                                            </div>
                                            <form action="{{ route('lapangan.update-status') }}" method="POST" class="inline-block ml-4">
                                                @csrf
                                                <input type="hidden" name="status"
                                                    value="{{ $ambulance->status == 'ready' ? 'offline' : 'ready' }}">
                                                <button type="submit"
                                                    class="px-4 py-2 rounded-full font-bold text-white text-xs shadow-lg transition transform hover:scale-105
                                                                                                                                                        {{ $ambulance->status == 'ready' ? 'bg-green-500 hover:bg-green-600' : 'bg-gray-500 hover:bg-gray-600' }}">
                                                    {{ $ambulance->status == 'ready' ? '🟢 SIAP TUGAS' : '⚫ ISTIRAHAT (OFF)' }}
                                                </button>
                                            </form>

                        @endif
                    </div>
                </div>
            </div>

            {{-- MENU GRID (HYBRID DASHBOARD) --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-2">
                <!-- 1. Jadwal -->
                <a href="{{ route('lapangan.schedules.index') }}"
                    class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:border-blue-300 transition text-center group">
                    <div
                        class="w-12 h-12 mx-auto bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition">
                        <i class="fas fa-calendar-alt text-xl"></i>
                    </div>
                    <span class="font-bold text-gray-700 text-sm group-hover:text-blue-600">Input Jadwal</span>
                </a>

                <!-- 2. Pesan -->
                <a href="{{ route('lapangan.messages.index') }}"
                    class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:border-blue-300 transition text-center group">
                    <div
                        class="w-12 h-12 mx-auto bg-yellow-50 text-yellow-600 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition">
                        <i class="fas fa-envelope text-xl"></i>
                    </div>
                    <span class="font-bold text-gray-700 text-sm group-hover:text-yellow-600">Pesan Masuk</span>
                </a>

                <!-- 3. Order (Scroll) -->
                <a href="#active-job-card"
                    class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:border-blue-300 transition text-center group">
                    <div
                        class="w-12 h-12 mx-auto bg-red-50 text-red-600 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition">
                        <i class="fas fa-exclamation-circle text-xl"></i>
                    </div>
                    <span class="font-bold text-gray-700 text-sm group-hover:text-red-600">Order/Tugas</span>
                </a>

                <!-- 4. Sterilisasi -->
                <a href="{{ route('lapangan.sterilizations.create') }}"
                    class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:border-blue-300 transition text-center group">
                    <div
                        class="w-12 h-12 mx-auto bg-teal-50 text-teal-600 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition">
                        <i class="fas fa-pump-soap text-xl"></i>
                    </div>
                    <span class="font-bold text-gray-700 text-sm group-hover:text-teal-600">Lapor Sterilisasi</span>
                </a>

                <!-- 5. Respon Time -->
                <a href="{{ route('lapangan.performance.index') }}"
                    class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:border-blue-300 transition text-center group">
                    <div
                        class="w-12 h-12 mx-auto bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition">
                        <i class="fas fa-stopwatch text-xl"></i>
                    </div>
                    <span class="font-bold text-gray-700 text-sm group-hover:text-purple-600">Respon Time</span>
                </a>
            </div>

            {{-- GPS TRACKER CARD --}}
            @if($ambulance)
                <div
                    class="bg-gradient-to-br from-indigo-600 to-blue-700 rounded-[2rem] shadow-xl shadow-blue-900/20 p-8 text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 w-48 h-48 bg-black/10 rounded-full -ml-10 -mb-10 blur-3xl"></div>

                    <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                        <div class="flex items-center gap-6">
                            <div
                                class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center text-3xl shadow-inner border border-white/20">
                                <i class="fas fa-satellite-dish animate-pulse"></i>
                            </div>
                            <div>
                                <h2 class="text-3xl font-black tracking-tight">GPS Tracker</h2>
                                <p class="text-blue-100 text-lg">Aktifkan saat memulai tugas pengantaran.</p>
                                <div id="gps-status"
                                    class="mt-3 inline-flex items-center gap-2 px-3 py-1 bg-black/20 rounded-lg text-sm font-mono text-blue-50 border border-white/10">
                                    <span class="w-2 h-2 bg-slate-400 rounded-full" id="status-dot"></span>
                                    <span id="gps-text">Menunggu aktivasi...</span>
                                </div>
                            </div>
                        </div>

                        <button id="toggle-gps"
                            class="w-full md:w-auto bg-white text-blue-700 hover:bg-blue-50 font-black py-4 px-8 rounded-xl shadow-lg transition-all transform hover:scale-105 active:scale-95 flex items-center justify-center gap-3">
                            <i class="fas fa-play"></i>
                            <span>MULAI PERJALANAN</span>
                        </button>
                    </div>
                </div>
            @endif

            {{-- ACTIVE JOB CARD --}}
            @if(isset($activeJob) && $activeJob)
                <div id="active-job-card"
                    class="bg-white rounded-[2rem] shadow-2xl shadow-red-500/10 border-2 border-red-100 overflow-hidden relative group">
                    <div class="absolute top-0 left-0 w-full h-2 bg-red-500 animate-loading-bar"></div>

                    <div class="p-8">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-14 h-14 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center text-2xl shadow-sm">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-black text-slate-800">TUGAS DARURAT</h3>
                                    <p class="text-slate-500 font-medium">{{ $activeJob->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div
                                class="bg-red-50 text-red-700 px-4 py-2 rounded-xl font-bold text-sm border border-red-100 animate-pulse">
                                PRIORITAS TINGGI
                            </div>
                        </div>

                        <div
                            class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50/50 p-6 rounded-2xl border border-slate-100">
                            <div class="space-y-1">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Keterangan Kejadian</p>
                                <p class="text-xl font-bold text-slate-800 leading-relaxed">{{ $activeJob->description }}
                                </p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Lokasi Pasien</p>
                                <p class="text-lg font-bold text-slate-800 flex items-start gap-2">
                                    <i class="fas fa-map-marker-alt text-red-500 mt-1"></i>
                                    {{ $activeJob->location }}
                                </p>
                                <p class="text-xs font-mono text-slate-400 pl-6">{{ $activeJob->latitude }},
                                    {{ $activeJob->longitude }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-8 flex flex-col md:flex-row gap-4">
                            <a href="https://www.google.com/maps/dir/?api=1&destination={{ $activeJob->latitude }},{{ $activeJob->longitude }}"
                                target="_blank"
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center font-bold py-4 px-6 rounded-2xl text-lg shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2">
                                <i class="fas fa-location-arrow"></i> NAVIGASI MAPS
                            </a>

                            <button onclick="document.getElementById('medicalModal').classList.remove('hidden')"
                                class="flex-1 bg-purple-600 text-white font-bold py-4 px-6 rounded-2xl text-lg shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2">
                                <i class="fas fa-notes-medical"></i> INPUT MEDIS
                            </button>

                            <form action="{{ route('lapangan.finish', $activeJob->id) }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit" onclick="return confirm('Yakin pasien sudah sampai ke Rumah Sakit?');"
                                    class="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-4 px-6 rounded-2xl text-lg shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2">
                                    <i class="fas fa-check-circle"></i> SELESAIKAN TUGAS
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- HOSPITAL SUGGESTION --}}
                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                    <div class="p-8 pb-0">
                        <h3 class="text-xl font-bold text-slate-800 flex items-center gap-3">
                            <span
                                class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-sm"><i
                                    class="fas fa-hospital"></i></span>
                            Rekomendasi RS Rujukan
                        </h3>
                        <p class="text-slate-500 text-sm mt-1 ml-11">Urutan berdasarkan ketersediaan Bed IGD terbanyak.</p>
                    </div>

                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr
                                        class="text-left text-xs font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                                        <th class="px-4 py-3 pb-4">Rumah Sakit</th>
                                        <th class="px-4 py-3 pb-4 text-center">IGD</th>
                                        <th class="px-4 py-3 pb-4 text-center">ICU</th>
                                        <th class="px-4 py-3 pb-4 text-center">Kontak</th>
                                        <th class="px-4 py-3 pb-4 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-slate-600">
                                    @forelse($hospitals as $rs)
                                        <tr
                                            class="border-b border-slate-50 hover:bg-slate-50/50 transition last:border-0 group">
                                            <td class="px-4 py-4">
                                                <p class="font-bold text-slate-800 group-hover:text-blue-600 transition">
                                                    {{ $rs->name }}
                                                </p>
                                                <p class="text-xs text-slate-400">{{ Str::limit($rs->address, 30) }}</p>
                                            </td>
                                            <td class="px-4 py-4 text-center">
                                                @if($rs->available_bed_igd > 0)
                                                    <span
                                                        class="bg-green-100 text-green-700 py-1 px-3 rounded-full text-xs font-bold shadow-sm">
                                                        {{ $rs->available_bed_igd }}
                                                    </span>
                                                @else
                                                    <span
                                                        class="bg-red-100 text-red-600 py-1 px-3 rounded-full text-xs font-bold">PENUH</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-4 text-center font-bold text-slate-700">
                                                {{ $rs->available_bed_icu }}
                                            </td>
                                            <td class="px-4 py-4 text-center">
                                                <a href="tel:{{ $rs->phone_igd }}"
                                                    class="w-8 h-8 bg-slate-100 hover:bg-blue-100 text-slate-500 hover:text-blue-600 rounded-full flex items-center justify-center mx-auto transition">
                                                    <i class="fas fa-phone"></i>
                                                </a>
                                            </td>
                                            <td class="px-4 py-4 text-right">
                                                <a href="https://www.google.com/maps/dir/?api=1&destination={{ $rs->latitude }},{{ $rs->longitude }}"
                                                    target="_blank"
                                                    class="inline-flex items-center gap-1 bg-white border border-slate-200 text-slate-600 hover:border-blue-300 hover:text-blue-600 px-3 py-1.5 rounded-lg text-xs font-bold transition shadow-sm">
                                                    <i class="fas fa-directions"></i> Rute
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-8 text-slate-400 italic">Data RS belum
                                                tersedia.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            @else
                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-12 text-center">
                    <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-4xl">☕</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800">Tidak ada tugas aktif</h3>
                    <p class="text-slate-500 mt-2">Silakan standby di Basecamp dan pastikan GPS Tracker aktif.</p>
                </div>
            @endif

        </div>

        {{-- MODAL INPUT MEDIS --}}
        <div id="medicalModal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-lg w-full p-6 max-h-[90vh] overflow-y-auto">
                <h3 class="text-xl font-bold mb-4">Rekam Medis Lapangan</h3>
                <form action="{{ route('lapangan.medical-record.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="emergency_call_id" value="{{ $activeJob->id ?? '' }}">

                    <div class="grid grid-cols-2 gap-4 mb-3">
                        <input type="text" name="tensi" placeholder="Tensi (120/80)"
                            class="w-full rounded-lg border-gray-300">
                        <input type="number" name="nadi" placeholder="Nadi (bpm)"
                            class="w-full rounded-lg border-gray-300">
                        <input type="number" step="0.1" name="suhu" placeholder="Suhu (C)"
                            class="w-full rounded-lg border-gray-300">
                        <input type="number" name="nafas" placeholder="Nafas (x/m)"
                            class="w-full rounded-lg border-gray-300">
                    </div>

                    <textarea name="keluhan_utama" placeholder="Keluhan Utama"
                        class="w-full rounded-lg border-gray-300 mb-3"></textarea>
                    <textarea name="tindakan" placeholder="Tindakan yang dilakukan"
                        class="w-full rounded-lg border-gray-300 mb-3"></textarea>

                    <label class="block text-sm font-bold mb-1">Foto Kejadian</label>
                    <input type="file" name="foto_kejadian" class="block w-full text-sm mb-4">

                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="document.getElementById('medicalModal').classList.add('hidden')"
                            class="bg-gray-200 px-4 py-2 rounded-lg font-bold">Batal</button>
                        <button type="submit"
                            class="bg-purple-600 text-white px-4 py-2 rounded-lg font-bold">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- DISASTER REPORT BUTTON --}}
        <button onclick="document.getElementById('disasterModal').classList.remove('hidden')"
            class="fixed bottom-24 right-6 z-50 w-16 h-16 bg-orange-500 rounded-full shadow-2xl border-4 border-white flex items-center justify-center text-white hover:scale-110 transition group">
            <i class="fas fa-bullhorn text-2xl group-hover:animate-wobble"></i>
            <span
                class="absolute right-20 bg-orange-600 text-white text-xs font-bold px-3 py-1 rounded-lg opacity-0 group-hover:opacity-100 transition whitespace-nowrap">
                Lapor Bencana
            </span>
        </button>

        {{-- MODAL LAPOR BENCANA --}}
        <div id="disasterModal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-lg w-full p-6 max-h-[90vh] overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">🚑 Laporan Bencana (RHA)</h3>
                    <button onclick="document.getElementById('disasterModal').classList.add('hidden')"
                        class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form action="{{ route('lapangan.disaster-report.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Lokasi Otomatis (Hidden) -->
                    <input type="hidden" name="latitude" id="rha_lat">
                    <input type="hidden" name="longitude" id="rha_long">

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Judul Kejadian</label>
                            <input type="text" name="title" placeholder="Contoh: Tanah Longsor Desa X" required
                                class="w-full rounded-xl border-gray-200 focus:border-orange-500 focus:ring-orange-500">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Lokasi</label>
                            <input type="text" name="location" placeholder="Nama Jalan / Area" required
                                class="w-full rounded-xl border-gray-200 focus:border-orange-500 focus:ring-orange-500">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Deskripsi Kejadian &
                                Kerusakan</label>
                            <textarea name="description" rows="3" placeholder="Jelaskan situasi dan kerusakan..."
                                required
                                class="w-full rounded-xl border-gray-200 focus:border-orange-500 focus:ring-orange-500"></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase">Luka Ringan</label>
                                <input type="number" name="casualties_light" value="0" min="0"
                                    class="w-full rounded-xl border-gray-200">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase">Luka Berat</label>
                                <input type="number" name="casualties_heavy" value="0" min="0"
                                    class="w-full rounded-xl border-gray-200">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase">Meninggal</label>
                                <input type="number" name="casualties_deceased" value="0" min="0"
                                    class="w-full rounded-xl border-gray-200">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase">Hilang</label>
                                <input type="number" name="casualties_missing" value="0" min="0"
                                    class="w-full rounded-xl border-gray-200">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Foto Bukti</label>
                            <input type="file" name="photo_proof" accept="image/*" required
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-2">
                        <button type="button" onclick="document.getElementById('disasterModal').classList.add('hidden')"
                            class="px-5 py-2.5 rounded-xl font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 transition">
                            Batal
                        </button>
                        <button type="submit" onclick="return confirm('Kirim Laporan Bencana?')"
                            class="px-5 py-2.5 rounded-xl font-bold text-white bg-orange-600 hover:bg-orange-700 shadow-lg hover:shadow-orange-500/30 transition">
                            Kirim Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- PANIC BUTTON --}}
        <button onclick="triggerPanic()"
            class="fixed bottom-6 right-6 z-50 w-16 h-16 bg-red-600 rounded-full shadow-2xl border-4 border-white flex items-center justify-center animate-pulse text-white hover:scale-110 transition">
            <i class="fas fa-exclamation-triangle text-2xl"></i>
        </button>

        <script>
            function triggerPanic() {
                if (!confirm("DARURAT: Kirim sinyal bahaya ke pusat?")) return;

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        fetch("{{ route('lapangan.panic-button') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                latitude: position.coords.latitude,
                                longitude: position.coords.longitude
                            })
                        }).then(res => res.json()).then(data => {
                            alert(data.message);
                        });
                    });
                } else {
                    alert("GPS mati.");
                }
            }
        </script>
        <script>
            // Auto-fill Location when RHA Modal Opens
            const rhaModal = document.getElementById('disasterModal');
            if (rhaModal) {
                const observer = new MutationObserver(function (mutations) {
                    mutations.forEach(function (mutation) {
                        if (mutation.attributeName === "class") {
                            if (!rhaModal.classList.contains('hidden')) {
                                // Modal Opened - Get Location
                                if (navigator.geolocation) {
                                    navigator.geolocation.getCurrentPosition(function (position) {
                                        document.getElementById('rha_lat').value = position.coords.latitude;
                                        document.getElementById('rha_long').value = position.coords.longitude;
                                        // Optional: Reverse Geocoding here if needed
                                    });
                                }
                            }
                        }
                    });
                });
                observer.observe(rhaModal, { attributes: true });
            }
        </script>
    </div>
    @push('scripts')
        {{-- SweetAlert2 --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var watchId = null;
                var isTracking = false;
                // Ganti ID ini sesuai ID Ambulan sopir yang login
                var ambulanceId = "{{ $ambulance->id ?? '' }}";

                var btn = document.getElementById('toggle-gps');
                var statusText = document.getElementById('gps-text');
                var statusDot = document.getElementById('status-dot');

                // If no button (no ambulance assigned), stop
                if (!btn) {
                    return;
                }

                btn.addEventListener('click', function () {
                    if (!isTracking) {
                        startTracking();
                    } else {
                        stopTracking();
                    }
                });

                function showAlert(title, text, icon) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: title,
                            text: text,
                            icon: icon,
                            timer: icon === 'success' || icon === 'info' ? 2000 : undefined,
                            showConfirmButton: icon === 'error'
                        });
                    } else {
                        alert(`${title}: ${text}`);
                    }
                }

                function startTracking() {
                    if (!navigator.geolocation) {
                        showAlert('Error', 'Browser Anda tidak mendukung GPS!', 'error');
                        return;
                    }

                    // Visual Feedback Loading
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> MENGHUBUNGKAN...';
                    statusText.innerText = 'Mencari sinyal GPS...';

                    navigator.geolocation.getCurrentPosition(function (position) {
                        // Sukses dapat lokasi pertama -> Aktifkan Tracking
                        isTracking = true;

                        // Update UI Button
                        btn.innerHTML = '<i class="fas fa-stop-circle"></i> STOP PERJALANAN';
                        btn.classList.remove('bg-white', 'text-blue-700', 'hover:bg-blue-50');
                        btn.classList.add('bg-red-500', 'text-white', 'hover:bg-red-600', 'border-red-600');

                        // Update Status Badge
                        if (statusDot) {
                            statusDot.classList.remove('bg-slate-400');
                            statusDot.classList.add('bg-green-400', 'animate-pulse');
                        }
                        statusText.innerText = 'GPS AKTIF - SIAP KIRIM DATA';

                        // Notifikasi Sukses
                        showAlert('Tracking Dimulai!', 'Lokasi Anda sekarang disiarkan ke warga & operator.', 'success');

                        // Mulai Watch Position (Realtime Update)
                        watchId = navigator.geolocation.watchPosition(sendPosition, handleError, {
                            enableHighAccuracy: true,
                            timeout: 5000,
                            maximumAge: 0
                        });

                    }, function (error) {
                        console.error("GPS Access Denied/Error", error);
                        showAlert('Gagal', 'Pastikan GPS aktif dan izinkan akses lokasi.', 'error');

                        btn.innerHTML = '<i class="fas fa-play"></i> MULAI PERJALANAN';
                        statusText.innerText = 'Gagal: Izin Ditolak / Timeout';
                    }, {
                        timeout: 10000 // 10 detik timeout untuk get awal
                    });
                }

                function stopTracking() {
                    isTracking = false;
                    navigator.geolocation.clearWatch(watchId);

                    // Reset UI
                    btn.innerHTML = '<i class="fas fa-play"></i> MULAI PERJALANAN';
                    btn.classList.add('bg-white', 'text-blue-700', 'hover:bg-blue-50');
                    btn.classList.remove('bg-red-500', 'text-white', 'hover:bg-red-600', 'border-red-600');

                    if (statusDot) {
                        statusDot.classList.add('bg-slate-400');
                        statusDot.classList.remove('bg-green-400', 'animate-pulse');
                    }
                    statusText.innerText = "Pelacakan dihentikan.";

                    showAlert('Tracking Berhenti', 'Lokasi tidak lagi dikirim.', 'info');
                }

                function sendPosition(position) {
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;
                    var timestamp = new Date().toLocaleTimeString();

                    statusText.innerText = `📡 Terkirim: ${lat.toFixed(6)}, ${lng.toFixed(6)} (${timestamp})`;

                    // Kirim ke API Laravel
                    if (ambulanceId) {
                        fetch(`/api/ambulance/${ambulanceId}/location`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Authorization': 'Bearer ' + "{{ session('api_token') }}"
                            },
                            body: JSON.stringify({
                                latitude: lat,
                                longitude: lng
                            })
                        }).then(res => {
                            if (res.status === 401 || res.status === 403) {
                                console.warn('Auth Error, fallback cookie auth usually handles this.');
                                // Fallback: Jika Sanctum token gagal, browser biasanya sudah kirim cookie session
                            }
                        })
                            .catch(err => console.error(err));
                    }
                }

                function handleError(error) {
                    console.error("WatchPosition Error", error);
                    statusText.innerText = "❌ Sinyal Hilang: " + error.message;
                }
            });
        </script>
    @endpush
</x-app-layout>