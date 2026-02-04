<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-600 leading-tight flex items-center gap-2">
            <span class="animate-pulse">🚨</span> {{ __('PANGGILAN DARURAT (SOS)') }}
        </h2>
    </x-slot>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Main Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="p-8">

                    <!-- Header Section -->
                    <div class="mb-8 border-b-2 border-red-500 pb-4 inline-block">
                        <h2 class="text-3xl font-extrabold text-red-600 dark:text-red-500 tracking-tight">
                            KONFIRMASI LOKASI KEJADIAN
                        </h2>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">
                            Sistem melacak koordinat Anda. Geser pin pada peta jika lokasi kurang akurat.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                        <!-- Left Column: Map -->
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300 flex items-center">
                                    <span class="mr-2">📍</span> Titik Koordinat Anda
                                </h3>
                                <div id="gps-indicator" class="flex items-center gap-1.5">
                                    <span class="relative flex h-3 w-3">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-gray-400 opacity-75"></span>
                                        <span id="indicator-dot" class="relative inline-flex rounded-full h-3 w-3 bg-gray-400"></span>
                                    </span>
                                    <span id="indicator-text" class="text-xs font-bold text-gray-400 uppercase tracking-widest">Mencari GPS...</span>
                                </div>
                            </div>

                            <div class="relative group">
                                <div id="map" class="h-[450px] w-full rounded-2xl shadow-inner border-4 border-gray-100 dark:border-gray-600 z-0"></div>
                                <div class="absolute bottom-4 left-4 bg-white/90 dark:bg-gray-800/90 backdrop-blur px-3 py-1 rounded shadow text-xs font-semibold text-gray-600 dark:text-gray-300 z-[400]">
                                    Geser pin untuk penyesuaian lokasi presisi
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Form -->
                        <div class="flex flex-col justify-center">
                            @if(session('error'))
                                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-r mb-6 animate-pulse">
                                    <p class="font-bold">Gagal:</p>
                                    <p>{{ session('error') }}</p>
                                </div>
                            @endif

                            <form action="{{ route('emergency.store') }}" method="POST" class="space-y-6">
                                @csrf

                                <!-- Hidden Inputs for Coordinates -->
                                <input type="hidden" name="latitude" id="latitude" required>
                                <input type="hidden" name="longitude" id="longitude" required>

                                <!-- Situasi Darurat -->
                                <div>
                                    <label for="description" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                                        Kronologi / Situasi Darurat:
                                    </label>
                                    <textarea name="description" id="description" rows="5"
                                        class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-xl py-3 px-4 text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-4 focus:ring-red-200 focus:border-red-500 transition shadow-sm font-medium"
                                        placeholder="Jelaskan kondisi saat ini (Contoh: Tabrakan beruntun 2 motor, 1 korban tidak sadar...)"
                                        required></textarea>
                                </div>

                                <!-- Info Box -->
                                <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl p-4 flex gap-3">
                                    <span class="text-xl">ℹ️</span>
                                    <p class="text-xs text-amber-800 dark:text-amber-200 leading-relaxed">
                                        Dengan mengirimkan permintaan ini, lokasi Anda akan dikirim ke sistem <b>Auto-Assign</b> untuk menugaskan ambulan terdekat secara otomatis.
                                    </p>
                                </div>

                                <!-- Submit Button -->
                                <div>
                                    <button type="submit" id="btn-submit"
                                        class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-extrabold py-5 px-6 rounded-2xl text-xl shadow-xl shadow-red-500/30 transition-all duration-300 transform hover:-translate-y-1 hover:scale-[1.02] flex items-center justify-center gap-3 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                                        disabled>
                                        <div id="btn-icon" class="animate-bounce">🚨</div>
                                        KIRIM PERMINTAAN BANTUAN
                                    </button>
                                    
                                    <p id="status-gps" class="text-center text-xs font-semibold text-gray-400 mt-4 tracking-wide uppercase italic">
                                        Menunggu koordinat GPS yang valid...
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        // 1. Inisialisasi Peta (Default Semarang)
        var map = L.map('map').setView([-6.966667, 110.416664], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        var marker;
        var dot = document.getElementById('indicator-dot');
        var text = document.getElementById('indicator-text');
        var statusLabel = document.getElementById('status-gps');
        var submitBtn = document.getElementById('btn-submit');

        // 2. Fungsi Deteksi Lokasi Otomatis
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError, {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                });
            } else {
                alert("Browser Anda tidak mendukung Geolocation.");
            }
        }

        // 3. Jika Lokasi Berhasil Didapatkan
        function showPosition(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;

            // Update Input Tersembunyi
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            // Kelola Marker di Peta
            if (marker) {
                map.removeLayer(marker);
            }
            
            // Marker bisa digeser (draggable) jika GPS meleset
            marker = L.marker([lat, lng], { 
                draggable: true,
                title: "Lokasi Anda"
            }).addTo(map);
            
            map.setView([lat, lng], 17);

            // Update UI Indikator
            dot.classList.remove('bg-gray-400');
            dot.classList.add('bg-green-500');
            text.innerText = "GPS AKTIF";
            text.classList.remove('text-gray-400');
            text.classList.add('text-green-600');

            // Aktifkan Tombol
            submitBtn.removeAttribute('disabled');
            statusLabel.innerText = "LOKASI DITEMUKAN. SILAKAN KIRIM PESAN DARURAT.";
            statusLabel.classList.remove('text-gray-400');
            statusLabel.classList.add('text-green-600');

            // Listener saat marker digeser manual
            marker.on('dragend', function (event) {
                var position = marker.getLatLng();
                document.getElementById('latitude').value = position.lat;
                document.getElementById('longitude').value = position.lng;
            });
        }

        // 4. Penanganan Error GPS
        function showError(error) {
            var msg = "";
            dot.classList.remove('bg-gray-400');
            dot.classList.add('bg-red-500');
            text.classList.remove('text-gray-400');
            text.classList.add('text-red-600');

            switch (error.code) {
                case error.PERMISSION_DENIED:
                    msg = "Izin lokasi ditolak.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    msg = "Lokasi tidak tersedia.";
                    break;
                case error.TIMEOUT:
                    msg = "Waktu akses lokasi habis.";
                    break;
                case error.UNKNOWN_ERROR:
                    msg = "Terjadi kesalahan sistem.";
                    break;
            }
            text.innerText = "GPS ERROR";
            statusLabel.innerText = "ERROR: " + msg + " Mohon izinkan GPS browser.";
            statusLabel.classList.add('text-red-600');
        }

        // Jalankan pelacakan saat halaman terbuka
        window.onload = getLocation;
    </script>
</x-app-layout>