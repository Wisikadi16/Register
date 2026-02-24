<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-3xl font-black text-charcoal tracking-tight">
                    WPS <span class="text-rescue-red font-semibold">Tim Lapangan</span>
                </h2>
                <p class="text-slate-500 font-medium mt-1">Sistem Respon Darurat & Ambulan</p>
            </div>
            <div class="bg-white border border-slate-200 px-5 py-2.5 rounded-full flex items-center gap-3 shadow-sm">
                <i class="fas fa-calendar-alt text-slate-400"></i>
                <span class="text-sm font-bold text-slate-700">
                    {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-10 min-h-screen bg-slate-50 font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- ELEVATED STATUS & WELCOME CARD --}}
            <div class="bg-gradient-to-r from-rescue-red to-red-600 rounded-[2rem] p-8 shadow-lg flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden group">
                <div class="relative z-10">
                    <h3 class="text-2xl font-bold text-white mb-2">Halo, {{ Auth::user()->name }}</h3>
                    @if($ambulance)
                        <div class="flex items-center gap-3 text-red-50 font-medium">
                            <i class="fas fa-ambulance text-white/70"></i> Armada Anda: 
                            <span class="font-bold text-rescue-red bg-white px-3 py-1 rounded-lg">{{ $ambulance->name }} ({{ $ambulance->plat_number }})</span>
                        </div>
                    @else
                        <p class="text-white font-bold flex items-center gap-2">
                            <i class="fas fa-exclamation-circle animate-pulse text-white/80"></i> Belum terhubung dengan unit ambulan. Hubungi Operator.
                        </p>
                    @endif
                </div>

                @if($ambulance)
                    <div class="flex items-center gap-5 bg-slate-50 px-6 py-4 rounded-3xl border border-slate-200 relative z-10 w-full md:w-auto justify-between md:justify-end">
                        <div class="flex flex-col">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Status Unit</span>
                            <div class="flex items-center gap-2">
                                <span class="relative flex h-3 w-3">
                                  @if($ambulance->status == 'ready')
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-teal-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-teal-500"></span>
                                  @elseif($ambulance->status == 'busy')
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rescue-red opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-rescue-red"></span>
                                  @else
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-slate-400"></span>
                                  @endif
                                </span>
                                <span class="font-black tracking-wider uppercase {{ $ambulance->status == 'ready' ? 'text-teal-600' : ($ambulance->status == 'busy' ? 'text-rescue-red' : 'text-slate-500') }}">
                                    {{ $ambulance->status }}
                                </span>
                            </div>
                        </div>

                        <form action="{{ route('lapangan.update-status') }}" method="POST" class="ml-4 pl-4 border-l border-slate-200">
                            @csrf
                            <input type="hidden" name="status" value="{{ $ambulance->status == 'ready' ? 'offline' : 'ready' }}">
                            <button type="submit" class="px-5 py-2.5 rounded-xl font-bold text-white text-xs shadow-sm shadow-blue-900/10 transition-transform active:scale-95 flex items-center gap-2 {{ $ambulance->status == 'ready' ? 'bg-teal-600 hover:bg-teal-700' : 'bg-charcoal hover:bg-slate-800' }}">
                                @if($ambulance->status == 'ready')
                                    <i class="fas fa-check"></i> Siap Tugas
                                @else
                                    <i class="fas fa-power-off"></i> Istirahat
                                @endif
                            </button>
                        </form>
                    </div>
                @endif
                <!-- Background Decoration -->
                <i class="fas fa-truck-medical absolute -right-6 -bottom-6 text-9xl text-slate-50 opacity-50 transform -rotate-12 group-hover:rotate-0 transition duration-700"></i>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- LEFT COLUMN: MENU & GPS --}}
                <div class="space-y-8 flex flex-col lg:col-span-1">
                    
                    <!-- MENU LAPANGAN -->
                    <div>
                        <h4 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-4 px-1">Menu Operasional</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <a href="{{ route('lapangan.schedules.index') }}" class="bg-white border border-slate-200 hover:border-blue-500 rounded-2xl p-5 flex flex-col items-center justify-center text-center transition group hover:shadow-md hover:shadow-blue-500/10 gap-3">
                                <i class="fas fa-calendar-alt text-2xl text-slate-300 group-hover:text-blue-500 transition"></i>
                                <span class="font-bold text-charcoal text-[11px] uppercase tracking-wider">Jadwal</span>
                            </a>
                            <a href="{{ route('lapangan.messages.index') }}" class="bg-white border border-slate-200 hover:border-amber-500 rounded-2xl p-5 flex flex-col items-center justify-center text-center transition group hover:shadow-md hover:shadow-amber-500/10 gap-3">
                                <i class="fas fa-envelope text-2xl text-slate-300 group-hover:text-amber-500 transition"></i>
                                <span class="font-bold text-charcoal text-[11px] uppercase tracking-wider">Pesan</span>
                            </a>
                            <a href="{{ route('lapangan.sterilizations.create') }}" class="bg-white border border-slate-200 hover:border-teal-500 rounded-2xl p-5 flex flex-col items-center justify-center text-center transition group hover:shadow-md hover:shadow-teal-500/10 gap-3">
                                <i class="fas fa-pump-soap text-2xl text-slate-300 group-hover:text-teal-500 transition"></i>
                                <span class="font-bold text-charcoal text-[11px] uppercase tracking-wider">Sterilisasi</span>
                            </a>
                            <a href="{{ route('lapangan.performance.index') }}" class="bg-white border border-slate-200 hover:border-purple-500 rounded-2xl p-5 flex flex-col items-center justify-center text-center transition group hover:shadow-md hover:shadow-purple-500/10 gap-3">
                                <i class="fas fa-stopwatch text-2xl text-slate-300 group-hover:text-purple-500 transition"></i>
                                <span class="font-bold text-charcoal text-[11px] uppercase tracking-wider">Performa</span>
                            </a>
                        </div>
                    </div>

                    <!-- GPS TRACKER -->
                    @if($ambulance)
                        <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm flex flex-col items-center text-center">
                            <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-2xl mb-4">
                                <i class="fas fa-satellite-dish"></i>
                            </div>
                            <h3 class="font-bold text-charcoal text-lg mb-1">Pelacak GPS</h3>
                            <p class="text-xs text-slate-400 mb-6 px-4">Aktifkan untuk membagikan lokasi Anda kepada Operator secara Real-Time.</p>
                            
                            <div id="gps-status" class="w-full bg-slate-50 border border-slate-100 rounded-xl py-3 px-4 mb-5 flex items-center justify-center gap-2">
                                <span class="w-2.5 h-2.5 bg-slate-300 rounded-full" id="status-dot"></span>
                                <span id="gps-text" class="text-xs font-bold text-slate-500 uppercase tracking-wider">Menunggu aktivasi</span>
                            </div>

                            <button id="toggle-gps" class="w-full bg-charcoal hover:bg-slate-800 text-white font-bold py-3.5 rounded-xl shadow-md transition-all active:scale-95 flex items-center justify-center gap-2 text-sm uppercase tracking-wider">
                                <i class="fas fa-play text-xs"></i> Mulai Tracking
                            </button>
                        </div>
                    @endif

                </div>

                {{-- RIGHT COLUMN: ACTIVE JOB & HOSPITALS --}}
                <div class="flex flex-col lg:col-span-2 space-y-8">
                    
                    @if(isset($activeJob) && $activeJob)
                        <!-- ACTIVE JOB CARD (Elegant Redesign) -->
                        <div id="active-job-card" class="bg-white rounded-[2rem] shadow-xl shadow-rescue-red/5 border border-rescue-red/20 overflow-hidden relative group">
                            <!-- Subtle Red Indicator Line -->
                            <div class="absolute top-0 left-0 w-full h-1.5 bg-rescue-red"></div>
                            
                            <div class="p-8">
                                <div class="flex justify-between items-start mb-8">
                                    <div class="flex items-center gap-4">
                                        <div class="w-14 h-14 bg-red-50 text-rescue-red rounded-2xl flex items-center justify-center text-2xl">
                                            <i class="fas fa-exclamation-triangle animate-pulse"></i>
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-black text-charcoal tracking-tight">TUGAS DARURAT AKTIF</h3>
                                            <p class="text-slate-500 text-sm font-medium mt-0.5"><i class="far fa-clock mr-1"></i> {{ $activeJob->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <span class="bg-rescue-red text-white px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm">
                                        Prioritas Tinggi
                                    </span>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 p-6 rounded-2xl border border-slate-100 mb-8">
                                    <div>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Keterangan Laporan</p>
                                        <p class="text-base font-bold text-charcoal leading-relaxed">{{ $activeJob->description }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Lokasi Penjemputan</p>
                                        <div class="flex items-start gap-2">
                                            <i class="fas fa-map-marker-alt text-rescue-red mt-1"></i>
                                            <div>
                                                <p class="text-sm font-bold text-charcoal">{{ $activeJob->location }}</p>
                                                <p class="text-xs text-slate-500 mt-1 font-mono bg-white px-2 py-0.5 rounded border border-slate-200 inline-block">{{ $activeJob->latitude }}, {{ $activeJob->longitude }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col sm:flex-row gap-4">
                                    <a href="https://www.google.com/maps/dir/?api=1&destination={{ $activeJob->latitude }},{{ $activeJob->longitude }}" target="_blank"
                                        class="flex-1 bg-white border-2 border-slate-200 hover:border-blue-600 text-slate-700 hover:text-blue-600 text-center font-bold py-3.5 rounded-xl text-sm transition-all flex items-center justify-center gap-2">
                                        <i class="fas fa-location-arrow"></i> Rute Navigasi
                                    </a>
                                    <button onclick="document.getElementById('medicalModal').classList.remove('hidden')"
                                        class="flex-1 bg-charcoal hover:bg-slate-800 text-white font-bold py-3.5 rounded-xl text-sm transition-all flex items-center justify-center gap-2 shadow-md">
                                        <i class="fas fa-notes-medical relative"><span class="absolute -top-1 -right-1 flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rescue-red opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-rescue-red"></span></span></i> Input Medis
                                    </button>
                                    <form action="{{ route('lapangan.finish', $activeJob->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" onclick="return confirm('Selesaikan penanganan pasien ini?');"
                                            class="w-full bg-teal-500 hover:bg-teal-600 text-white font-bold py-3.5 rounded-xl text-sm shadow-md transition-all flex items-center justify-center gap-2">
                                            <i class="fas fa-check-circle"></i> Selesai
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- HOSPITAL SUGGESTIONS (Sleek List) -->
                        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                            <div class="p-6 border-b border-slate-100 flex items-center gap-4">
                                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl">
                                    <i class="fas fa-hospital"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-charcoal">Rekomendasi RS Rujukan</h3>
                                    <p class="text-xs font-medium text-slate-400">Pilih berdasarkan ketersediaan Bed IGD terdekat</p>
                                </div>
                            </div>
                            <div class="p-4">
                                <div class="space-y-2 max-h-[300px] overflow-y-auto custom-scrollbar pr-2">
                                    @forelse($hospitals as $rs)
                                        <div class="flex items-center justify-between p-4 bg-slate-50 hover:bg-white border border-transparent hover:border-slate-200 rounded-2xl transition duration-300 group">
                                            <div class="flex-1">
                                                <h4 class="font-bold text-charcoal text-sm group-hover:text-blue-600 transition">{{ $rs->name }}</h4>
                                                <p class="text-[11px] text-slate-400 mt-1 line-clamp-1 pr-4">{{ $rs->address }}</p>
                                            </div>
                                            <div class="flex items-center gap-6">
                                                <div class="text-center">
                                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">IGD</p>
                                                    @if($rs->available_bed_igd > 0)
                                                        <span class="bg-teal-100 text-teal-700 py-1 px-3 rounded-md text-xs font-black">{{ $rs->available_bed_igd }}</span>
                                                    @else
                                                        <span class="bg-rescue-red/10 text-rescue-red py-1 px-2 rounded-md text-[10px] font-black">PENUH</span>
                                                    @endif
                                                </div>
                                                <div class="flex gap-2">
                                                    <a href="tel:{{ $rs->phone_igd }}" class="w-10 h-10 bg-white border border-slate-200 text-slate-500 hover:text-green-500 hover:border-green-500 hover:bg-green-50 rounded-xl flex items-center justify-center transition shadow-sm">
                                                        <i class="fas fa-phone"></i>
                                                    </a>
                                                    <a href="https://www.google.com/maps/dir/?api=1&destination={{ $rs->latitude }},{{ $rs->longitude }}" target="_blank" class="w-10 h-10 bg-white border border-slate-200 text-slate-500 hover:text-blue-600 hover:border-blue-600 hover:bg-blue-50 rounded-xl flex items-center justify-center transition shadow-sm">
                                                        <i class="fas fa-directions"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center py-6 text-slate-400 text-sm">Belum ada data Rumah Sakit</div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                    @else
                        <!-- EMPTY STATE -->
                        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm flex flex-col items-center justify-center p-16 text-center h-full min-h-[400px]">
                            <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-6 text-slate-300 text-4xl">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h3 class="text-2xl font-black text-charcoal mb-2">Semua Aman Terkendali</h3>
                            <p class="text-slate-500 max-w-sm">Tidak ada panggilan darurat masuk. Silakan standby di armada dan pastikan <strong class="text-charcoal border-b border-dashed border-slate-300">GPS Tracker aktif</strong> jika Anda sedang berpatroli.</p>
                        </div>
                    @endif
                </div>
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