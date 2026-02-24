<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-3xl font-black text-charcoal tracking-tight">
                    WPS <span class="text-rescue-red font-semibold">Tanggapan Darurat</span>
                </h2>
                <p class="text-slate-500 font-medium mt-1">Sistem Pelayanan Medis Warga</p>
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

            {{-- Flash Message Success (Minimalist) --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show"
                    class="bg-white border border-emerald-200 text-charcoal p-5 rounded-2xl shadow-sm flex items-start gap-4 transition-all relative">
                    <div
                        class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 shrink-0">
                        <i class="fas fa-check-circle text-xl"></i>
                    </div>
                    <div>
                        <p class="font-bold text-base">Berhasil!</p>
                        <p class="text-slate-500 text-sm mt-0.5">{{ session('success') }}</p>
                    </div>
                    <button @click="show = false"
                        class="absolute top-5 right-5 text-slate-400 hover:text-charcoal transition">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            {{-- 1. HERO SECTION (Dynamic State) --}}
            @if(isset($activeCall) && $activeCall)
                {{-- EMERGENCY STATE --}}
                <div
                    class="bg-white rounded-[2rem] p-8 md:p-10 border border-rescue-red/30 shadow-2xl shadow-rescue-red/10 relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-8 group">
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-rescue-red z-20"></div>
                    <div
                        class="absolute -top-24 -right-24 w-64 h-64 bg-red-50 rounded-full blur-3xl opacity-50 z-0 animate-pulse">
                    </div>

                    <div class="relative z-10 text-center md:text-left space-y-5 flex-1 w-full">
                        <div
                            class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-red-50 text-rescue-red text-xs font-black tracking-widest border border-red-100 shadow-sm animate-pulse mx-auto md:mx-0">
                            <i class="fas fa-info-circle"></i> STATUS DARURAT AKTIF
                        </div>

                        <h1 class="text-3xl md:text-4xl font-black text-charcoal tracking-tight">
                            Bantuan Segera Tiba!
                        </h1>

                        <p class="text-slate-500 text-lg max-w-2xl leading-relaxed">
                            @if($activeCall->ambulance)
                                Armada Bantuan
                                <span
                                    class="bg-slate-100 text-charcoal font-bold px-3 py-1 rounded-lg inline-block mx-1 border border-slate-200 shadow-sm">
                                    {{ $activeCall->ambulance->name }} <span
                                        class="text-[10px] text-slate-400 uppercase ml-1">{{ $activeCall->ambulance->plat_number }}</span>
                                </span>
                                sedang meluncur. Persiapkan diri Anda dan tetap tenang.
                            @else
                                Sistem kami sedang mengirimkan armada terdekat ke lokasi Anda. Mohon <strong
                                    class="text-charcoal border-b border-rescue-red border-dashed">tetap tenang</strong> dan
                                pastikan ponsel aktif.
                            @endif
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4 pt-4 justify-center md:justify-start">
                            <button
                                class="bg-white border-2 border-slate-200 text-slate-700 hover:border-blue-600 hover:text-blue-600 px-8 py-3.5 rounded-xl font-bold transition-all shadow-sm flex items-center justify-center gap-3 active:scale-95">
                                <i class="fas fa-phone-alt animate-bounce"></i> Hubungi Operator
                            </button>
                            <a href="https://www.google.com/maps/dir/?api=1&destination={{ $activeCall->latitude }},{{ $activeCall->longitude }}"
                                target="_blank"
                                class="bg-charcoal text-white shadow-md hover:bg-slate-800 px-8 py-3.5 rounded-xl font-bold transition-all flex items-center justify-center gap-3 active:scale-95">
                                <i class="fas fa-location-arrow"></i> Buka Navigasi
                            </a>
                        </div>
                    </div>

                    <div
                        class="relative z-10 w-32 h-32 md:w-40 md:h-40 bg-red-50 rounded-3xl flex items-center justify-center border border-red-100 shadow-inner group-hover:scale-105 transition duration-500 shrink-0 mx-auto">
                        <i class="fas fa-ambulance text-6xl text-rescue-red animate-bounce-slow"></i>
                    </div>
                </div>

                {{-- MAP TRACKING CARD --}}
                <div class="mt-8 bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8">
                    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h3 class="text-xl font-bold text-charcoal flex items-center gap-3">
                                <div class="w-10 h-10 bg-blue-50 text-blue-600 flex items-center justify-center rounded-xl">
                                    <i class="fas fa-satellite-dish"></i>
                                </div>
                                Pantauan Armada Real-Time
                            </h3>
                        </div>
                        <div class="flex items-center gap-2 bg-slate-50 border border-slate-200 px-4 py-2 rounded-xl">
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">Estimasi Tiba:</span>
                            <span id="estimasi" class="font-black text-charcoal text-sm">- mnt</span>
                            <span class="w-2 h-2 bg-blue-500 rounded-full animate-ping ml-2"></span>
                        </div>
                    </div>

                    <div id="map" class="w-full h-[400px] rounded-2xl border border-slate-200 z-0 bg-slate-100">
                        <!-- Map rendered here -->
                    </div>
                </div>

                @push('styles')
                    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
                    <style>
                        .user-marker-icon {
                            background-color: #3b82f6;
                            border: 3px solid white;
                            border-radius: 50%;
                            width: 20px;
                            height: 20px;
                            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                            animation: pulse-blue 2s infinite;
                        }

                        @keyframes pulse-blue {
                            0% {
                                transform: scale(0.95);
                                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7);
                            }

                            70% {
                                transform: scale(1);
                                box-shadow: 0 0 0 12px rgba(59, 130, 246, 0);
                            }

                            100% {
                                transform: scale(0.95);
                                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0);
                            }
                        }
                    </style>
                @endpush

                @push('scripts')
                    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            var mapElement = document.getElementById('map');
                            if (!mapElement) return;

                            var map = L.map('map').setView([-6.175392, 106.827153], 15);
                            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                maxZoom: 19,
                                attribution: '&copy; OpenStreetMap'
                            }).addTo(map);

                            var ambulanceIcon = L.icon({
                                iconUrl: 'https://cdn-icons-png.flaticon.com/512/263/263086.png',
                                iconSize: [40, 40],
                                iconAnchor: [20, 20],
                                popupAnchor: [0, -20]
                            });

                            var userIcon = L.divIcon({ className: 'user-marker-icon' });
                            var ambulanceId = "{{ $activeCall->ambulance_id ?? 1 }}";
                            var userLat = {{ $activeCall->latitude ?? -6.175392 }};
                            var userLng = {{ $activeCall->longitude ?? 106.827153 }};
                            var userMarker = L.marker([userLat, userLng], { icon: userIcon }).addTo(map).bindPopup("Lokasi Saya").openPopup();
                            var ambulanceMarker = L.marker([userLat, userLng], { icon: ambulanceIcon }).addTo(map);

                            function updateAmbulanceLocation() {
                                fetch(`/api/ambulance/${ambulanceId}/location`)
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.latitude && data.longitude) {
                                            var newLatLng = new L.LatLng(data.latitude, data.longitude);
                                            ambulanceMarker.setLatLng(newLatLng);
                                            ambulanceMarker.bindPopup(`<div class="font-bold text-slate-800">Ambulan ${data.unit}</div><div class="text-[10px] text-slate-500 mt-1">Update: ${data.last_update}</div>`).openPopup();
                                            var group = new L.featureGroup([userMarker, ambulanceMarker]);
                                            map.fitBounds(group.getBounds().pad(0.1));
                                        }
                                    })
                                    .catch(error => console.error('Gagal ambil lokasi:', error));
                            }
                            setInterval(updateAmbulanceLocation, 5000);
                            updateAmbulanceLocation();
                        });
                    </script>
                @endpush

            @else
                {{-- SAFE STATE (Compact Greeting) --}}
                <div
                    class="bg-gradient-to-r from-rescue-red to-red-600 rounded-[1.5rem] p-6 shadow-md flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden group">
                    <div
                        class="absolute top-0 right-0 w-48 h-48 bg-white rounded-full blur-3xl opacity-10 -translate-y-1/2 translate-x-1/2 text-white">
                    </div>

                    <div class="relative z-10 w-full text-center md:text-left flex-1 md:pr-4">
                        <div
                            class="inline-flex items-center gap-2 px-2.5 py-1 rounded bg-white/20 border border-white/20 text-white text-[9px] font-black uppercase tracking-widest mb-3 shadow-sm backdrop-blur-sm">
                            <i class="fas fa-shield-alt text-white text-xs"></i> Sistem Siaga Penuh
                        </div>
                        <h1 class="text-2xl md:text-3xl font-black text-white tracking-tight mb-2">
                            Halo, {{ Auth::user()->name }} 👋
                        </h1>
                        <p class="text-red-50 text-sm md:text-base leading-snug">
                            Akses layanan kesehatan terpadu dan tanggap darurat. Tekan tombol <strong
                                class="text-white">SOS</strong> jika Anda berada dalam kondisi medis mendesak.
                        </p>
                    </div>

                    <div
                        class="relative z-10 hidden md:flex shrink-0 w-24 h-24 bg-white/20 border border-white/20 rounded-2xl shadow-inner items-center justify-center text-white/70 text-4xl group-hover:scale-105 group-hover:-rotate-3 transition duration-700 backdrop-blur-sm">
                        <i class="fas fa-heartbeat text-white"></i>
                    </div>
                </div>
            @endif

            {{-- 2. QUICK ACCESS GRID (Sleek Minimalist Cards) --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

                {{-- EMERGENCY BUTTON (SOS - Premium Redesign) --}}
                <a href="{{ route('emergency.create') }}"
                    class="col-span-2 group bg-rescue-red rounded-[2rem] p-8 shadow-xl shadow-rescue-red/20 relative overflow-hidden flex items-center justify-center border border-rescue-red hover:shadow-2xl hover:shadow-rescue-red/30 transition-all duration-300 transform hover:-translate-y-1">
                    <!-- Subtle pulsing glow effect -->
                    <div class="absolute inset-0 bg-gradient-to-tr from-black/10 to-transparent"></div>
                    <div
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-48 h-48 bg-white/10 rounded-full blur-2xl animate-pulse">
                    </div>

                    <div class="relative z-10 flex flex-col items-center text-center gap-3">
                        <div
                            class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-ambulance text-3xl text-rescue-red"></i>
                        </div>
                        <div>
                            <h3 class="font-black text-3xl text-white tracking-tight drop-shadow-sm mb-1 uppercase">
                                Panggil Ambulan</h3>
                            <p class="text-[11px] text-white/80 font-bold uppercase tracking-widest">Sinyal SOS Darurat
                            </p>
                        </div>
                    </div>
                </a>

                {{-- CALL CENTER BUTTON (In-App Request) --}}
                <form id="phoneCallForm" action="{{ route('emergency.store') }}" method="POST" class="col-span-2">
                    @csrf
                    <input type="hidden" name="type" value="phone_call">
                    <input type="hidden" name="latitude" id="pc_latitude" value="-6.175392">
                    <input type="hidden" name="longitude" id="pc_longitude" value="106.827153">
                    <input type="hidden" name="description" value="Permintaan Telepon Call Center 112">

                    <button type="button" onclick="submitPhoneCall()"
                        class="w-full h-full group bg-blue-600 rounded-[2rem] p-8 shadow-xl shadow-blue-600/20 relative overflow-hidden flex items-center justify-center border border-blue-500 hover:shadow-2xl hover:shadow-blue-600/30 transition-all duration-300 transform hover:-translate-y-1 text-left">
                        <div class="absolute inset-0 bg-gradient-to-tr from-black/10 to-transparent"></div>
                        <div
                            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-48 h-48 bg-white/10 rounded-full blur-2xl">
                        </div>

                        <div class="relative z-10 flex flex-col items-center text-center gap-3">
                            <div
                                class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 group-hover:rotate-12 transition-transform duration-300">
                                <i class="fas fa-headset text-4xl text-blue-600"></i>
                            </div>
                            <div>
                                <h3 class="font-black text-3xl text-white tracking-tight drop-shadow-sm mb-1 uppercase">
                                    Call Center 112</h3>
                                <p class="text-[11px] text-white/80 font-bold uppercase tracking-widest">Minta Ditelepon
                                    Operator</p>
                            </div>
                        </div>
                    </button>
                </form>

                {{-- Cari Faskes --}}
                <a href="{{ route('public.faskes') }}"
                    class="col-span-1 md:col-span-2 group bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 hover:border-blue-500 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 flex flex-col items-center justify-center text-center gap-4">
                    <div
                        class="w-14 h-14 bg-slate-50 group-hover:bg-blue-50 rounded-2xl flex items-center justify-center text-2xl text-slate-400 group-hover:text-blue-600 transition-colors">
                        <i class="fas fa-hospital-alt"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-charcoal text-base mb-1">Cari Faskes</h3>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">RS & Klinik Terdekat
                        </p>
                    </div>
                </a>

                {{-- Panduan P3K --}}
                <a href="{{ route('public.p3k') }}"
                    class="col-span-1 md:col-span-2 group bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 hover:border-amber-500 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 flex flex-col items-center justify-center text-center gap-4">
                    <div
                        class="w-14 h-14 bg-slate-50 group-hover:bg-amber-50 rounded-2xl flex items-center justify-center text-2xl text-slate-400 group-hover:text-amber-500 transition-colors">
                        <i class="fas fa-book-medical"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-charcoal text-base mb-1">Panduan P3K</h3>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Pertolongan Pertama
                        </p>
                    </div>
                </a>
            </div>

            {{-- 3. CONTENT SECTION --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Riwayat Panggilan (Clean Elegant List) --}}
                <div
                    class="lg:col-span-2 bg-white rounded-[2rem] shadow-sm border border-slate-100 flex flex-col h-full overflow-hidden">
                    <div class="p-8 pb-4 flex justify-between items-center">
                        <div>
                            <h3 class="font-black text-xl text-charcoal flex items-center gap-3 tracking-tight">
                                Riwayat Laporan Terakhir
                            </h3>
                        </div>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-slate-100 hover:text-charcoal transition active:scale-95">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <div class="flex-1 overflow-y-auto max-h-[450px] p-6 pt-2 space-y-3 custom-scrollbar">
                        @forelse($history as $call)
                                            <div
                                                class="group bg-slate-50 hover:bg-white border border-transparent hover:border-slate-200 p-5 rounded-2xl transition duration-300 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                                <div class="flex items-start sm:items-center gap-4">
                                                    <div
                                                        class="w-12 h-12 rounded-xl flex items-center justify-center text-xl shrink-0 border border-slate-100/50 shadow-sm
                                                                                                                                            {{ $call->status == 'completed' ? 'bg-teal-50 text-teal-600' :
                            ($call->status == 'cancelled' ? 'bg-white text-slate-400' :
                                ($call->status == 'process' ? 'bg-amber-50 text-amber-600' : 'bg-red-50 text-rescue-red')) }}">
                                                        @if($call->status == 'completed') <i class="fas fa-check"></i>
                                                        @elseif($call->status == 'cancelled') <i class="fas fa-times"></i>
                                                        @elseif($call->status == 'process') <i class="fas fa-ambulance"></i>
                                                        @else <i class="fas fa-exclamation"></i>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <h4
                                                            class="font-bold text-charcoal text-sm mb-1 group-hover:text-amber-600 transition">
                                                            {{ $call->description ?? 'Laporan Darurat Medis' }}
                                                        </h4>
                                                        <div
                                                            class="flex items-center gap-2 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                                                            <i class="far fa-calendar-alt"></i> {{ $call->created_at->format('d M Y') }}
                                                            <span class="w-1 h-1 bg-slate-300 rounded-full mx-1"></span>
                                                            <i class="far fa-clock"></i> {{ $call->created_at->format('H:i') }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="self-end sm:self-center">
                                                    <span
                                                        class="px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest
                                                                                                                                            {{ $call->status == 'completed' ? 'bg-teal-50 text-teal-600 border border-teal-100' :
                            ($call->status == 'cancelled' ? 'bg-slate-100 text-slate-500' :
                                ($call->status == 'process' ? 'bg-amber-50 text-amber-600 border border-amber-100' : 'bg-red-50 text-rescue-red border border-red-100')) }}">
                                                        {{ $call->status }}
                                                    </span>
                                                </div>
                                            </div>
                        @empty
                            <div class="flex flex-col items-center justify-center py-16 text-slate-400 text-center">
                                <div
                                    class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 text-slate-200 text-4xl">
                                    <i class="fas fa-folder-open"></i>
                                </div>
                                <p class="font-bold text-charcoal mb-1">Belum Ada Riwayat</p>
                                <p class="text-sm">Anda belum pernah melakukan panggilan darurat.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- SIDEBAR: Profile & Info Sehat --}}
                <div class="space-y-6">

                    {{-- Minimalist Profile Card --}}
                    <div
                        class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 flex flex-col items-center text-center">
                        <div
                            class="w-20 h-20 bg-slate-50 border-4 border-white shadow-md rounded-[1.5rem] flex items-center justify-center text-3xl font-black text-charcoal mb-4 rotate-3">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <h4 class="text-xl font-bold text-charcoal">{{ Auth::user()->name }}</h4>
                        <p class="text-[13px] font-medium text-slate-400 mb-6">{{ Auth::user()->email }}</p>

                        <div class="w-full grid grid-cols-2 gap-3 mb-6">
                            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">Gol. Darah
                                </p>
                                <p class="text-lg font-black text-charcoal">-</p>
                            </div>
                            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">Usia
                                    Dewasa</p>
                                <p class="text-lg font-black text-charcoal">- <span
                                        class="text-[10px] font-medium text-slate-400">thn</span></p>
                            </div>
                        </div>

                        <a href="{{ route('profile.edit') }}"
                            class="w-full py-3.5 rounded-xl bg-charcoal text-white text-[13px] font-bold hover:bg-slate-800 transition duration-300 shadow-sm">
                            Pengaturan Profil
                        </a>
                    </div>

                    {{-- Elegant Info Card --}}
                    <div class="bg-charcoal p-8 rounded-[2rem] shadow-xl text-white relative overflow-hidden group">
                        <!-- Decorative Abstract -->
                        <div
                            class="absolute -right-10 -bottom-10 w-40 h-40 border-4 border-slate-700 rounded-full opacity-50 group-hover:scale-110 transition duration-700">
                        </div>
                        <div
                            class="absolute -right-4 -bottom-4 w-32 h-32 border-4 border-slate-600 rounded-full opacity-50 group-hover:scale-110 transition duration-500 delay-75">
                        </div>

                        <div class="relative z-10">
                            <div
                                class="w-12 h-12 bg-slate-800 rounded-2xl flex items-center justify-center text-amber-400 text-2xl mb-5 shadow-inner">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h4 class="font-bold text-white text-lg mb-2">Tips Kesehatan</h4>
                            <p class="text-slate-400 text-[13px] leading-relaxed">
                                Jaga asupan cairan Anda hari ini. Dehidrasi ringan sering kali tidak disadari dan dapat
                                memengaruhi konsentrasi serta daya tahan tubuh Anda.
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

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(-5%);
                animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
            }

            50% {
                transform: none;
                animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
            }
        }
    </style>

    @push('scripts')
        <script>
            function submitPhoneCall() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            document.getElementById('pc_latitude').value = position.coords.latitude;
                            document.getElementById('pc_longitude').value = position.coords.longitude;
                            document.getElementById('phoneCallForm').submit();
                        },
                        function(error) {
                            console.warn("Geolocation denied or failed. Submitting with default coordinates.");
                            // Submit anyway with default coordinates
                            document.getElementById('phoneCallForm').submit();
                        },
                        { enableHighAccuracy: true, timeout: 5000, maximumAge: 0 }
                    );
                } else {
                    // Browser doesn't support Geolocation
                    document.getElementById('phoneCallForm').submit();
                }
            }
        </script>
    @endpush
</x-app-layout>