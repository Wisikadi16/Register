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
                        @endif
                    </div>
                </div>
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
                <div
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