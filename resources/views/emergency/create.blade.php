<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-600 leading-tight">
            {{ __('PANGGILAN DARURAT (SOS)') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Main Card -->
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="p-8">

                    <div class="mb-8 border-b-2 border-red-500 pb-4 inline-block">
                        <h2 class="text-3xl font-extrabold text-red-600 dark:text-red-500 tracking-tight">PANGGILAN
                            DARURAT (SOS)</h2>
                        <p class="text-gray-500 text-sm mt-1">Sistem akan melacak lokasi Anda secara otomatis.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                        <!-- Left: Map -->
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300 flex items-center">
                                    <span class="mr-2">📍</span> Lokasi Anda
                                </h3>
                                <span class="text-xs bg-teal-100 text-teal-800 px-2 py-1 rounded-full font-semibold">GPS
                                    Active</span>
                            </div>

                            <div class="relative group">
                                <div id="map"
                                    class="h-96 w-full rounded-2xl shadow-inner border-4 border-gray-100 dark:border-gray-600 z-0">
                                </div>
                                <div
                                    class="absolute bottom-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded shadow text-xs font-semibold text-gray-600 z-[400]">
                                    Geser pin untuk penyesuaian akurat
                                </div>
                            </div>
                        </div>

                        <!-- Right: Form -->
                        <div class="flex flex-col justify-center">
                            @if(session('error'))
                                <div
                                    class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-r mb-6 animate-pulse">
                                    <p class="font-bold">Error:</p>
                                    <p>{{ session('error') }}</p>
                                </div>
                            @endif

                            <form action="{{ route('emergency.store') }}" method="POST" class="space-y-6">
                                @csrf

                                <input type="hidden" name="latitude" id="latitude" required>
                                <input type="hidden" name="longitude" id="longitude" required>

                                <div>
                                    <label for="description"
                                        class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Kronologi
                                        / Situasi Darurat:</label>
                                    <textarea name="description" id="description" rows="5"
                                        class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-xl py-3 px-4 text-gray-700 focus:outline-none focus:ring-4 focus:ring-red-200 focus:border-red-500 transition shadow-sm font-medium"
                                        placeholder="Contoh: Kecelakaan motor, korban tidak sadarkan diri..."
                                        required></textarea>
                                </div>

                                <div>
                                    <button type="submit" id="btn-submit"
                                        class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-extrabold py-5 px-6 rounded-2xl text-xl shadow-xl shadow-red-500/30 transition-all duration-300 transform hover:-translate-y-1 hover:scale-[1.02] flex items-center justify-center gap-3 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                                        disabled>
                                        <div class="animate-bounce">🚨</div>
                                        KIRIM PERMINTAAN BANTUAN
                                    </button>
                                    <p id="status-gps"
                                        class="text-center text-xs font-semibold text-gray-400 mt-4 tracking-wide">
                                        <span
                                            class="inline-block w-2 h-2 rounded-full bg-gray-400 mr-1 animate-ping"></span>
                                        Sedang mencari koordinat GPS...
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        // 1. Inisialisasi Peta (Default ke Semarang)
        var map = L.map('map').setView([-6.966667, 110.416664], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var marker;

        // 2. Fungsi Deteksi Lokasi Otomatis (GPS Browser)
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation tidak didukung oleh browser ini.");
            }
        }

        // 3. Jika Lokasi Ditemukan
        function showPosition(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;

            // Update Input Form
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            // Pindahkan Marker Peta
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker([lat, lng], { draggable: true }).addTo(map);
            map.setView([lat, lng], 16);

            // Aktifkan Tombol Submit
            document.getElementById('btn-submit').removeAttribute('disabled');
            document.getElementById('btn-submit').classList.remove('opacity-50', 'cursor-not-allowed');
            document.getElementById('status-gps').innerText = "Lokasi ditemukan! Siap memanggil bantuan.";
            document.getElementById('status-gps').classList.add('text-green-600');

            // Fitur Geser Marker (Jika GPS kurang pas)
            marker.on('dragend', function (event) {
                var position = marker.getLatLng();
                document.getElementById('latitude').value = position.lat;
                document.getElementById('longitude').value = position.lng;
            });
        }

        // 4. Handle Error GPS
        function showError(error) {
            var msg = "";
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    msg = "User menolak permintaan Geolocation. Mohon izinkan akses lokasi.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    msg = "Informasi lokasi tidak tersedia.";
                    break;
                case error.TIMEOUT:
                    msg = "Waktu permintaan lokasi habis.";
                    break;
                case error.UNKNOWN_ERROR:
                    msg = "Terjadi kesalahan yang tidak diketahui.";
                    break;
            }
            document.getElementById('status-gps').innerText = "Error: " + msg;
            document.getElementById('status-gps').classList.add('text-red-600');
        }

        // Jalankan saat halaman dimuat
        getLocation();

    </script>
</x-app-layout>