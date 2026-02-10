<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 dark:text-slate-200 leading-tight tracking-tight">
            {{ __('Dashboard Overview') }}
        </h2>
    </x-slot>

    <div class="py-8 min-h-screen bg-slate-50 dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Flash Message Success (Lebih Modern) --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show"
                    class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-2xl shadow-sm flex items-start gap-4 animate-fade-in-down relative overflow-hidden">
                    <div class="flex-shrink-0 bg-emerald-100 rounded-full p-2 text-emerald-600">
                        <i class="fas fa-check-circle text-xl"></i>
                    </div>
                    <div>
                        <p class="font-bold text-lg">Berhasil!</p>
                        <p class="text-emerald-700/80">{{ session('success') }}</p>
                    </div>
                    <button @click="show = false"
                        class="absolute top-4 right-4 text-emerald-400 hover:text-emerald-600 transition">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            {{-- 1. HERO SECTION (Dynamic State) --}}
            @if(isset($activeCall) && $activeCall)
                {{-- EMERGENCY STATE (Lebih Intens tapi Rapi) --}}
                <div class="relative group overflow-hidden rounded-[2rem] shadow-2xl shadow-red-500/30">
                    <div class="absolute inset-0 bg-gradient-to-br from-rose-600 via-red-600 to-red-700"></div>

                    <div
                        class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/diagmonds-light.png')]">
                    </div>
                    <div
                        class="absolute -top-24 -right-24 w-96 h-96 bg-rose-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse">
                    </div>

                    <div class="relative z-10 p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-8">
                        <div class="text-center md:text-left space-y-4 flex-1">
                            <div
                                class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-red-800/30 border border-red-400/30 backdrop-blur-md text-red-50 text-sm font-semibold tracking-wide animate-pulse">
                                <span class="w-2 h-2 rounded-full bg-red-400 animate-ping"></span>
                                STATUS DARURAT AKTIF
                            </div>

                            <h1 class="text-4xl md:text-6xl font-black text-white tracking-tight drop-shadow-sm">
                                Bantuan Segera Tiba!
                            </h1>

                            <p class="text-red-100 text-lg md:text-xl font-medium leading-relaxed max-w-2xl">
                                @if($activeCall->ambulance)
                                    Ambulan <span
                                        class="text-white font-bold bg-red-700/50 px-2 py-0.5 rounded">{{ $activeCall->ambulance->name }}</span>
                                    sedang meluncur ke lokasi.
                                @else
                                    Sistem sedang mencari armada terdekat. Mohon tetap tenang dan jangan matikan ponsel.
                                @endif
                            </p>

                            <div class="pt-4 flex flex-wrap justify-center md:justify-start gap-4">
                                <button
                                    class="bg-white text-rose-600 px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl hover:bg-slate-50 hover:-translate-y-1 transition-all duration-300 flex items-center gap-3 group/btn">
                                    <i class="fas fa-phone-alt group-hover/btn:animate-tada"></i> Hubungi Operator
                                </button>
                                <a href="https://www.google.com/maps/dir/?api=1&destination={{ $activeCall->latitude }},{{ $activeCall->longitude }}"
                                    target="_blank"
                                    class="bg-red-800/40 border border-red-400/30 text-white px-8 py-4 rounded-xl font-semibold backdrop-blur-md hover:bg-red-800/60 transition flex items-center gap-3">
                                    <i class="fas fa-map-marked-alt"></i> Pantau Lokasi
                                </a>
                            </div>
                        </div>

                        <div class="relative">
                            <div class="absolute inset-0 bg-white/20 rounded-full blur-2xl transform scale-110"></div>
                            <i
                                class="fas fa-ambulance text-[10rem] text-white drop-shadow-2xl animate-bounce-slow relative z-10"></i>
                        </div>
                    </div>
                </div>

                {{-- MAP TRACKING CARD --}}
                <div
                    class="mt-8 bg-white dark:bg-gray-800 rounded-[2rem] shadow-xl p-6 border border-slate-100 dark:border-gray-700">
                    <div class="mb-6 flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-bold text-slate-800 dark:text-white flex items-center gap-2">
                                <i class="fas fa-map-marked-alt text-blue-500"></i> Pantau Lokasi Ambulan
                            </h3>
                            <p class="text-slate-500 text-sm mt-1">Estimasi tiba: <span id="estimasi"
                                    class="font-bold text-slate-800 dark:text-gray-200">- menit</span></p>
                        </div>
                        <div
                            class="animate-pulse flex items-center gap-2 text-blue-600 bg-blue-50 px-3 py-1 rounded-full text-xs font-bold">
                            <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                            LIVE TRACKING
                        </div>
                    </div>

                    <div id="map" class="w-full h-96 rounded-2xl border-2 border-slate-200 dark:border-gray-600 z-0 text-slate-800"></div>
                </div>

                @push('styles')
                <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
                <style>
                    /* Animasi berdenyut untuk marker user */
                    .user-marker-icon {
                        background-color: #3b82f6;
                        border: 3px solid white;
                        border-radius: 50%;
                        width: 20px;
                        height: 20px;
                        box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7);
                        animation: pulse-blue 2s infinite;
                    }
                    @keyframes pulse-blue {
                        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7); }
                        70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(59, 130, 246, 0); }
                        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
                    }
                </style>
                @endpush

                @push('scripts')
                <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Cek apakah elemen map ada
                        var mapElement = document.getElementById('map');
                        if (!mapElement) return;

                        // 1. Inisialisasi Peta (Default ke Monas dulu sebelum dapat lokasi)
                        var map = L.map('map').setView([-6.175392, 106.827153], 15);

                        // 2. Pasang Tile Layer (OpenStreetMap - Gratis)
                        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                        }).addTo(map);

                        // 3. Icon Custom
                        var ambulanceIcon = L.icon({
                            iconUrl: 'https://cdn-icons-png.flaticon.com/512/263/263086.png', // Gambar Ambulan
                            iconSize: [40, 40],
                            iconAnchor: [20, 20],
                            popupAnchor: [0, -20]
                        });

                        var userIcon = L.divIcon({ className: 'user-marker-icon' });

                        // 4. Data Dummy Awal (Ganti dengan data real dari Backend nanti)
                        var ambulanceId = "{{ $activeCall->ambulance_id ?? 1 }}"; 
                        
                        // Lokasi User (Pemanggil)
                        var userLat = {{ $activeCall->latitude ?? -6.175392 }}; 
                        var userLng = {{ $activeCall->longitude ?? 106.827153 }};
                        var userMarker = L.marker([userLat, userLng], {icon: userIcon}).addTo(map).bindPopup("Lokasi Anda").openPopup();

                        // Marker Ambulan (Akan bergerak)
                        var ambulanceMarker = L.marker([userLat, userLng], {icon: ambulanceIcon}).addTo(map);

                        // 5. Fungsi Update Lokasi Ambulan (Real-time Polling)
                        function updateAmbulanceLocation() {
                            fetch(`/api/ambulance/${ambulanceId}/location`)
                                .then(response => response.json())
                                .then(data => {
                                    if(data.latitude && data.longitude) {
                                        var newLatLng = new L.LatLng(data.latitude, data.longitude);
                                        ambulanceMarker.setLatLng(newLatLng); // Pindahkan marker
                                        
                                        // Update popup info
                                        ambulanceMarker.bindPopup(`<b>Ambulan ${data.unit}</b><br>Update: ${data.last_update}`).openPopup();
                                        
                                        // Auto zoom supaya User & Ambulan masuk dalam layar
                                        var group = new L.featureGroup([userMarker, ambulanceMarker]);
                                        map.fitBounds(group.getBounds().pad(0.1));
                                    }
                                })
                                .catch(error => console.error('Gagal ambil lokasi:', error));
                        }

                        // Jalankan update setiap 5 detik
                        setInterval(updateAmbulanceLocation, 5000);
                        updateAmbulanceLocation(); // Jalankan sekali di awal
                    });
                </script>
                @endpush
            @else
                {{-- SAFE STATE (Lebih Fresh & Calm) --}}
                <div
                    class="relative overflow-hidden rounded-[2rem] bg-white dark:bg-gray-800 shadow-xl shadow-teal-900/5 border border-slate-100 dark:border-gray-700">
                    <div
                        class="absolute top-0 right-0 w-full h-full bg-gradient-to-bl from-teal-50 via-transparent to-transparent opacity-70">
                    </div>
                    <div class="absolute -top-10 -right-10 w-64 h-64 bg-teal-100 rounded-full blur-3xl opacity-60"></div>

                    <div class="relative z-10 p-8 md:p-10 flex flex-col md:flex-row items-center justify-between">
                        <div class="space-y-3">
                            <div
                                class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-teal-50 text-teal-600 text-xs font-bold uppercase tracking-wider mb-2">
                                <i class="fas fa-shield-alt"></i> Sistem Siaga
                            </div>
                            <h1 class="text-3xl md:text-5xl font-extrabold text-slate-800 dark:text-white tracking-tight">
                                Halo, <span
                                    class="text-transparent bg-clip-text bg-gradient-to-r from-teal-500 to-emerald-600">{{ Auth::user()->name }}</span>
                                👋
                            </h1>
                            <p class="text-slate-500 dark:text-slate-400 text-lg max-w-xl leading-relaxed">
                                Kesehatan adalah prioritas. Tekan tombol darurat di bawah jika Anda membutuhkan pertolongan
                                medis mendesak.
                            </p>
                        </div>
                        <div class="hidden md:block opacity-10 rotate-12">
                            <i class="fas fa-heartbeat text-9xl text-teal-900"></i>
                        </div>
                    </div>
                </div>
            @endif

            {{-- 2. QUICK ACCESS GRID (Card Modern dengan Hover Effect) --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

                {{-- Emergency Button (Primary) --}}
                <a href="{{ route('emergency.create') }}"
                    class="col-span-2 group relative overflow-hidden bg-white dark:bg-gray-800 p-1 rounded-3xl shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-red-500 to-rose-500 opacity-0 group-hover:opacity-10 transition-opacity duration-300">
                    </div>
                    <div
                        class="h-full bg-white dark:bg-gray-800 rounded-[20px] p-6 border border-slate-100 dark:border-gray-700 flex flex-col items-center justify-center text-center gap-4 relative z-10">
                        <div
                            class="w-20 h-20 bg-red-50 dark:bg-red-900/20 rounded-2xl flex items-center justify-center text-4xl text-red-500 group-hover:scale-110 group-hover:bg-red-500 group-hover:text-white transition-all duration-300 shadow-sm">
                            <i class="fas fa-procedures"></i>
                        </div>
                        <div>
                            <h3
                                class="font-bold text-slate-800 dark:text-white text-xl group-hover:text-red-600 transition-colors">
                                Panggil Ambulan</h3>
                            <p class="text-sm text-slate-500 mt-1">Sinyal SOS Darurat</p>
                        </div>
                    </div>
                </a>

                {{-- Cari Faskes --}}
                <a href="{{ route('public.faskes') }}"
                    class="group bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-gray-700 hover:shadow-lg hover:border-blue-200 transition-all duration-300 hover:-translate-y-1 flex flex-col items-center justify-center text-center gap-4">
                    <div
                        class="w-16 h-16 bg-blue-50 dark:bg-blue-900/20 rounded-2xl flex items-center justify-center text-2xl text-blue-600 group-hover:rotate-6 transition-transform duration-300">
                        <i class="fas fa-hospital-alt"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-800 dark:text-white text-lg">Cari Faskes</h3>
                        <p class="text-xs text-slate-500 mt-1">RS & Klinik Terdekat</p>
                    </div>
                </a>

                {{-- Edukasi / P3K --}}
                <a href="{{ route('public.p3k') }}"
                    class="group bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-gray-700 hover:shadow-lg hover:border-amber-200 transition-all duration-300 hover:-translate-y-1 flex flex-col items-center justify-center text-center gap-4">
                    <div
                        class="w-16 h-16 bg-amber-50 dark:bg-amber-900/20 rounded-2xl flex items-center justify-center text-2xl text-amber-500 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-book-medical"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-800 dark:text-white text-lg">Panduan P3K</h3>
                        <p class="text-xs text-slate-500 mt-1">Pertolongan Pertama</p>
                    </div>
                </a>
            </div>

            {{-- 3. CONTENT SECTION --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- List Riwayat (Clean List) --}}
                <div
                    class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-[2rem] shadow-sm border border-slate-100 dark:border-gray-700 flex flex-col h-full">
                    <div class="p-8 border-b border-slate-50 dark:border-gray-700 flex justify-between items-center">
                        <div>
                            <h3 class="font-bold text-xl text-slate-800 dark:text-white">Riwayat Panggilan</h3>
                            <p class="text-sm text-slate-400 mt-1">Aktivitas permintaan bantuan terakhir</p>
                        </div>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-teal-50 hover:text-teal-600 transition">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <div class="flex-1 overflow-y-auto max-h-[500px] p-2">
                        @forelse($history as $call)
                                            <div
                                                class="group p-4 rounded-2xl hover:bg-slate-50 dark:hover:bg-gray-700/50 transition duration-300 flex items-center justify-between mb-2">
                                                <div class="flex items-center gap-5">
                                                    <div
                                                        class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-sm text-lg shrink-0
                                                                                                    {{ $call->status == 'completed' ? 'bg-emerald-100 text-emerald-600' :
                            ($call->status == 'cancelled' ? 'bg-slate-100 text-slate-500' :
                                ($call->status == 'process' ? 'bg-amber-100 text-amber-600' : 'bg-red-100 text-red-600')) }}">
                                                        @if($call->status == 'completed') <i class="fas fa-check"></i>
                                                        @elseif($call->status == 'cancelled') <i class="fas fa-times"></i>
                                                        @elseif($call->status == 'process') <i class="fas fa-ambulance"></i>
                                                        @else <i class="fas fa-exclamation"></i>
                                                        @endif
                                                    </div>

                                                    <div>
                                                        <h4
                                                            class="font-bold text-slate-800 dark:text-gray-200 group-hover:text-teal-600 transition">
                                                            {{ $call->description ?? 'Panggilan Darurat Medis' }}
                                                        </h4>
                                                        <div class="flex items-center gap-3 text-xs text-slate-500 mt-1.5 font-medium">
                                                            <span class="flex items-center gap-1"><i class="far fa-calendar-alt"></i>
                                                                {{ $call->created_at->format('d M Y') }}</span>
                                                            <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                                            <span class="flex items-center gap-1"><i class="far fa-clock"></i>
                                                                {{ $call->created_at->format('H:i') }} WIB</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <span
                                                    class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider
                                                                                                {{ $call->status == 'completed' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' :
                            ($call->status == 'cancelled' ? 'bg-slate-50 text-slate-500 border border-slate-100' :
                                ($call->status == 'process' ? 'bg-amber-50 text-amber-600 border border-amber-100' : 'bg-red-50 text-red-600 border border-red-100')) }}">
                                                    {{ ucfirst($call->status) }}
                                                </span>
                                            </div>
                        @empty
                            <div class="flex flex-col items-center justify-center h-64 text-slate-400">
                                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-clipboard-list text-3xl opacity-20"></i>
                                </div>
                                <p class="font-medium">Belum ada riwayat panggilan.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Sidebar Info (Profile & Health) --}}
                <div class="space-y-6">
                    {{-- Profile Card --}}
                    <div
                        class="bg-white dark:bg-gray-800 p-8 rounded-[2rem] shadow-sm border border-slate-100 dark:border-gray-700 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-teal-50 rounded-full -mr-10 -mt-10 blur-2xl">
                        </div>

                        <div class="relative z-10 flex flex-col items-center text-center">
                            <div
                                class="w-24 h-24 bg-gradient-to-br from-teal-400 to-emerald-500 p-1 rounded-full shadow-lg mb-4">
                                <div
                                    class="w-full h-full bg-white rounded-full flex items-center justify-center text-3xl font-black text-teal-600">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            </div>

                            <h4 class="text-xl font-bold text-slate-800 dark:text-white">{{ Auth::user()->name }}</h4>
                            <p class="text-sm text-slate-500 mb-6">{{ Auth::user()->email }}</p>

                            <div class="w-full grid grid-cols-2 gap-4 mb-6">
                                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Gol. Darah
                                    </p>
                                    <p class="text-xl font-black text-slate-700">-</p>
                                </div>
                                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Usia</p>
                                    <p class="text-xl font-black text-slate-700">- <span
                                            class="text-xs font-normal text-slate-400">thn</span></p>
                                </div>
                            </div>

                            <a href="{{ route('profile.edit') }}"
                                class="w-full py-3 rounded-xl border border-teal-200 text-teal-600 font-bold hover:bg-teal-50 transition duration-300">
                                Edit Profil Medis
                            </a>
                        </div>
                    </div>

                    {{-- Info Banner --}}
                    <div
                        class="bg-gradient-to-br from-blue-500 to-indigo-600 p-6 rounded-[2rem] shadow-lg text-white relative overflow-hidden">
                        <div class="absolute -bottom-4 -right-4 text-white opacity-10 text-8xl">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <div class="relative z-10">
                            <h4 class="font-bold text-lg mb-2 flex items-center gap-2">
                                <i class="fas fa-info-circle"></i> Info Sehat
                            </h4>
                            <p class="text-blue-50 text-sm leading-relaxed opacity-90">
                                Jaga pola makan dan istirahat yang cukup. Dehidrasi sering terjadi tanpa disadari, minum
                                8 gelas air hari ini!
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        .animate-bounce-slow {
            animation: bounce 3s infinite;
        }

        .animate-tada {
            animation: tada 1s;
        }

        @keyframes tada {
            0% {
                transform: scale(1);
            }

            10%,
            20% {
                transform: scale(0.9) rotate(-3deg);
            }

            30%,
            50%,
            70%,
            90% {
                transform: scale(1.1) rotate(3deg);
            }

            40%,
            60%,
            80% {
                transform: scale(1.1) rotate(-3deg);
            }

            100% {
                transform: scale(1) rotate(0);
            }
        }
    </style>
</x-app-layout>