<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-600 leading-tight">
            {{ __('PANGGILAN DARURAT (SOS)') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div>
                            <h3 class="text-lg font-bold mb-2">Lokasi Anda Saat Ini</h3>
                            <div id="map" style="height: 400px; width: 100%; border-radius: 10px; border: 2px solid #ddd;"></div>
                            <p class="text-sm text-gray-500 mt-2">*Pastikan GPS Anda aktif. Geser pin jika lokasi kurang tepat.</p>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold mb-4">Detail Kejadian</h3>

                            @if(session('error'))
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('emergency.store') }}" method="POST">
                                @csrf

                                <input type="hidden" name="latitude" id="latitude" required>
                                <input type="hidden" name="longitude" id="longitude" required>

                                <div class="mb-4">
                                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Jelaskan Situasi Darurat:</label>
                                    <textarea name="description" id="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Contoh: Kecelakaan motor, korban tidak sadarkan diri. Depan Alfamart." required></textarea>
                                </div>

                                <button type="submit" id="btn-submit" class="w-full bg-red-600 hover:bg-red-800 text-white font-bold py-4 px-4 rounded-lg text-xl shadow-lg transition duration-300 ease-in-out transform hover:scale-105 flex items-center justify-center gap-2" disabled>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    PANGGIL AMBULAN TERDEKAT
                                </button>
                                <p id="status-gps" class="text-center text-sm text-gray-500 mt-2">Sedang mencari lokasi...</p>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

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
            marker = L.marker([lat, lng], {draggable: true}).addTo(map);
            map.setView([lat, lng], 16);

            // Aktifkan Tombol Submit
            document.getElementById('btn-submit').removeAttribute('disabled');
            document.getElementById('btn-submit').classList.remove('opacity-50', 'cursor-not-allowed');
            document.getElementById('status-gps').innerText = "Lokasi ditemukan! Siap memanggil bantuan.";
            document.getElementById('status-gps').classList.add('text-green-600');

            // Fitur Geser Marker (Jika GPS kurang pas)
            marker.on('dragend', function(event) {
                var position = marker.getLatLng();
                document.getElementById('latitude').value = position.lat;
                document.getElementById('longitude').value = position.lng;
            });
        }

        // 4. Handle Error GPS
        function showError(error) {
            var msg = "";
            switch(error.code) {
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