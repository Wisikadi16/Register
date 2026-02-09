<x-app-layout>
    <div class="py-6 flex flex-col items-center justify-center min-h-[80vh] bg-gray-100 dark:bg-gray-900 px-4">
        {{-- Header Section --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-red-600 tracking-wider animate-pulse">DARURAT</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2 text-sm" id="status-text">
                <i class="fas fa-satellite-dish fa-spin mr-1"></i> Mencari lokasi Anda...
            </p>
        </div>

        {{-- Main Form --}}
        <form id="sos-form" action="{{ route('emergency.store') }}" method="POST" enctype="multipart/form-data"
            class="w-full max-w-md flex flex-col items-center gap-6">
            @csrf

            {{-- Hidden Inputs for Geolocation --}}
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">

            {{-- Panic Button Container --}}
            <div class="relative group">
                {{-- Pulse Ring Effect --}}
                <div class="absolute inset-0 bg-red-500 rounded-full opacity-75 animate-ping hidden" id="pulse-ring">
                </div>

                {{-- Main Button --}}
                <button type="submit" id="sos-btn" disabled
                    class="relative w-64 h-64 bg-gray-400 rounded-full shadow-[0_0_30px_rgba(220,38,38,0.6)] flex flex-col items-center justify-center text-white transition-all duration-300 transform hover:scale-105 active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed border-4 border-white dark:border-gray-800">
                    <span class="text-5xl font-extrabold tracking-widest drop-shadow-md">SOS</span>
                    <span class="text-xs mt-2 opacity-80 uppercase tracking-wide">Tekan untuk Bantuan</span>
                </button>
            </div>

            {{-- Optional Inputs Section --}}
            <div class="w-full bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 mt-6 transition-all duration-300 transform translate-y-0 opacity-100"
                id="extra-inputs">

                {{-- Photo Upload --}}
                <div class="mb-4">
                    <label
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                        <i class="fas fa-camera"></i> Foto Kejadian (Opsional)
                    </label>
                    <input type="file" name="photo" accept="image/*" capture="environment"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 transition-colors">
                </div>

                {{-- Description --}}
                <div class="mb-2">
                    <label
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                        <i class="fas fa-comment-medical"></i> Keterangan (Opsional)
                    </label>
                    <textarea name="description" rows="2"
                        placeholder="Contoh: Kecelakaan motor, pingsan, sesak nafas..."
                        class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:ring-red-500 focus:border-red-500 shadow-sm text-sm"></textarea>
                </div>
            </div>

            {{-- Alert Box (Hidden by default) --}}
            <div id="error-alert"
                class="hidden w-full bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-md"
                role="alert">
                <p class="font-bold">Gagal Mendapatkan Lokasi</p>
                <p class="text-sm">Mohon aktifkan GPS/Lokasi di browser Anda untuk menggunakan fitur ini.</p>
                <button type="button" onclick="location.reload()"
                    class="mt-2 text-xs bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Coba Lagi</button>
            </div>

        </form>

        {{-- Fullscreen Loading Overlay --}}
        <div id="loading-overlay"
            class="fixed inset-0 bg-gray-900 bg-opacity-90 z-50 flex flex-col items-center justify-center hidden">
            <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-red-600 mb-4"></div>
            <h2 class="text-white text-xl font-bold tracking-wider animate-pulse">MENGHUBUNGI OPERATOR...</h2>
            <p class="text-gray-300 text-sm mt-2">Jangan tutup halaman ini.</p>
        </div>
    </div>

    {{-- Script for Logic --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sosBtn = document.getElementById('sos-btn');
            const statusText = document.getElementById('status-text');
            const latInput = document.getElementById('latitude');
            const lngInput = document.getElementById('longitude');
            const pulseRing = document.getElementById('pulse-ring');
            const errorAlert = document.getElementById('error-alert');
            const form = document.getElementById('sos-form');
            const loadingOverlay = document.getElementById('loading-overlay');
            const pulseRingElement = document.getElementById('pulse-ring');

            // 1. Get Geolocation on Load
            if (navigator.geolocation) {
                // Tampilkan loading/mencari lokasi
                sosBtn.disabled = true;

                navigator.geolocation.getCurrentPosition(successLocation, errorLocation, {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                });
            } else {
                showError("Browser tidak mendukung Geolocation.");
            }

            // 2. Success Handler
            function successLocation(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                latInput.value = lat;
                lngInput.value = lng;

                // Update UI: Ready state
                sosBtn.removeAttribute('disabled');
                sosBtn.classList.remove('bg-gray-400');
                sosBtn.classList.add('bg-red-600', 'hover:bg-red-700');

                statusText.innerHTML = '<i class="fas fa-map-marker-alt text-green-500"></i> Lokasi Ditemukan. Siap Panggil!';
                statusText.classList.remove('text-gray-600');
                statusText.classList.add('text-green-600', 'font-semibold');

                // Activate animations
                if (pulseRingElement) {
                    pulseRingElement.classList.remove('hidden');
                }
            }

            // 3. Error Handler
            function errorLocation(error) {
                console.warn("Geolocation Error:", error);

                let msg = "Gagal mendeteksi lokasi.";
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        msg = "Izin lokasi ditolak. Harap izinkan akses lokasi.";
                        break;
                    case error.POSITION_UNAVAILABLE:
                        msg = "Informasi lokasi tidak tersedia.";
                        break;
                    case error.TIMEOUT:
                        msg = "Waktu permintaan lokasi habis.";
                        break;
                }
                showError(msg);
            }

            function showError(msg) {
                sosBtn.setAttribute('disabled', 'true');
                sosBtn.classList.add('bg-gray-400');
                sosBtn.classList.remove('bg-red-600');

                statusText.innerHTML = '<i class="fas fa-exclamation-triangle text-red-500"></i> ' + msg;
                statusText.classList.remove('text-gray-600', 'text-green-600');
                statusText.classList.add('text-red-500');

                errorAlert.classList.remove('hidden');
                // Use querySelector to safely find the p tag
                const pTag = errorAlert.querySelectorAll('p')[1];
                if (pTag) pTag.innerText = msg;
            }

            // 4. Form Submit Handler
            form.addEventListener('submit', function (e) {
                // Prevent multiple submits or submit without location
                if (sosBtn.disabled) {
                    e.preventDefault();
                    return;
                }

                // Check again for latitude/longitude just in case
                if (!latInput.value || !lngInput.value) {
                    e.preventDefault();
                    showError("Lokasi belum ditemukan!");
                    return;
                }

                // Show Loading and Disable
                loadingOverlay.classList.remove('hidden');
                sosBtn.setAttribute('disabled', 'true');
            });
        });
    </script>
</x-app-layout>