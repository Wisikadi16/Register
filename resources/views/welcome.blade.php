<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Ambulans Darurat 24 Jam</title>
    <meta name="description"
        content="Layanan ambulans darurat 24 jam dengan respon tercepat. Hubungi kami untuk bantuan medis darurat segera.">

    <!-- Google Fonts: Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS (Catatan: Saat dipindah ke view Laravel, ganti baris ini dengan @vite(['resources/css/app.css', 'resources/js/app.js'])) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Konfigurasi Custom Tema Tailwind -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'rescue-red': '#D7263D', /* Merah Darurat */
                        'charcoal': '#2B2D42',   /* Abu-abu Arang */
                        'light-gray': '#EDF2F4', /* Background Terang */
                    },
                    fontFamily: {
                        sans: ['Montserrat', 'sans-serif'],
                    },
                    animation: {
                        'pulse-custom': 'pulse-btn 2s infinite',
                    },
                    keyframes: {
                        'pulse-btn': {
                            '0%': { transform: 'scale(1)', boxShadow: '0 0 0 0 rgba(215, 38, 61, 0.7)' },
                            '50%': { transform: 'scale(1.05)', boxShadow: '0 0 0 15px rgba(215, 38, 61, 0)' },
                            '100%': { transform: 'scale(1)', boxShadow: '0 0 0 0 rgba(215, 38, 61, 0)' },
                        }
                    }
                }
            }
        }
    </script>
</head>

<body
    class="bg-light-gray text-charcoal font-sans antialiased overflow-x-hidden selection:bg-rescue-red selection:text-white">

    <!-- 1. Header (Sticky Top / Tetap Terlihat Saat Scroll) -->
    <header class="bg-white px-6 py-4 flex justify-between items-center sticky top-0 z-50 shadow-sm">
        <a href="/" class="text-2xl font-black text-charcoal tracking-tight">
            AMBULAN<span class="text-rescue-red">HEBAT</span>
        </a>
        <div class="flex items-center gap-6">
            @auth
                @php
                    $dashboardUrl = url('/dashboard');
                    if (Auth::user()->role === 'super_admin') {
                        $dashboardUrl = route('super-admin.dashboard');
                    } elseif (Auth::user()->role === 'admin') {
                        $dashboardUrl = route('admin.dashboard');
                    } elseif (Auth::user()->role === 'operator') {
                        $dashboardUrl = route('operator.dashboard');
                    } elseif (in_array(Auth::user()->role, ['driver', 'nakes'])) {
                        $dashboardUrl = route('lapangan.dashboard');
                    }
                @endphp
                <a href="{{ $dashboardUrl }}" class="text-charcoal font-bold hover:text-rescue-red">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-charcoal font-bold hover:text-rescue-red">Masuk</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-charcoal font-bold hover:text-rescue-red">Daftar</a>
                @endif
            @endauth

            <!-- CTA di Desktop (Sembunyi di Mobile) -->
            <a href="tel:112"
                class="hidden md:inline-block bg-rescue-red text-white font-black px-6 py-3 rounded-lg uppercase tracking-wide shadow-[0_4px_15px_rgba(215,38,61,0.4)] hover:bg-[#b01c30] hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-rescue-red/50 transition-all duration-200">
                CALL 112
            </a>
        </div>
    </header>

    <!-- 2. Hero Section Fullscreen (Gambar Latar Ambulans & CTA Raksasa) -->
    <section class="relative h-[90vh] flex items-center px-6 md:px-12 bg-charcoal">
        <!-- Background Image dengan Overlay Gelap -->
        <div class="absolute inset-0 z-0 opacity-50 bg-cover bg-center"
            style="background-image: url('https://pbs.twimg.com/profile_images/1888867171604037632/4TxJ_vsz_400x400.jpg'); background-blend-mode: multiply;">
        </div>
        <div class="absolute inset-0 z-0 bg-gradient-to-br from-charcoal to-slate-900 opacity-80"></div>
        <!-- Overlay Charcoal -->

        <div class="relative z-10 max-w-3xl text-white text-center md:text-left mx-auto md:mx-0">
            <h1 class="text-5xl md:text-7xl font-black leading-tight mb-6 tracking-tight">
                DARURAT MEDIS?<br>KAMI SIAP 24 JAM.
            </h1>
            <p class="text-lg md:text-xl md:max-w-xl text-gray-300 mb-10">
                Respon cepat dengan armada medis lengkap. Jangan panik, tim ahli kami segera meluncur ke lokasi Anda
                saat ini juga.
            </p>
            <!-- Tombol Berdenyut (Desktop) -->
            <a href="tel:112"
                class="hidden md:inline-block w-full sm:w-auto bg-rescue-red text-white text-xl font-black px-10 py-5 rounded-lg uppercase tracking-wide shadow-[0_4px_20px_rgba(215,38,61,0.5)] animate-pulse-custom hover:bg-[#b01c30] transition-colors duration-200">
                PANGGIL AMBULANS
            </a>
            <!-- Instruksi untuk pengguna Mobile -->
            <div class="md:hidden text-gray-300 font-bold bg-charcoal/50 inline-block px-4 py-2 rounded-lg">
                Tekan tombol merah di kanan bawah.
            </div>
        </div>
    </section>

    <!-- 3. Cara Kerja (Scanning Cepat / Z-Pattern Layout) -->
    <section class="py-24 px-6 md:px-12 bg-white text-center border-b border-gray-200">
        <h2 class="text-3xl md:text-4xl font-black text-charcoal mb-16 tracking-tight">Tiga Langkah Cepat</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- Step 01 -->
            <div
                class="bg-light-gray p-8 rounded-xl text-left border-t-4 border-rescue-red shadow-sm hover:shadow-md transition-shadow">
                <div class="text-6xl font-black text-rescue-red/20 leading-none mb-4">01</div>
                <h3 class="text-2xl font-bold mb-3 text-charcoal">Tekan Tombol</h3>
                <p class="text-gray-600 leading-relaxed font-medium">Klik tombol merah di layar Anda atau hubungi nomor
                    darurat 112. Sistem kami siaga 24/7 tanpa henti.</p>
            </div>

            <!-- Step 02 -->
            <div
                class="bg-light-gray p-8 rounded-xl text-left border-t-4 border-rescue-red shadow-sm hover:shadow-md transition-shadow">
                <div class="text-6xl font-black text-rescue-red/20 leading-none mb-4">02</div>
                <h3 class="text-2xl font-bold mb-3 text-charcoal">Beri Lokasi</h3>
                <p class="text-gray-600 leading-relaxed font-medium">Informasikan kondisi pasien dan titik lokasi Anda
                    secara singkat kepada operator responsif kami.</p>
            </div>

            <!-- Step 03 -->
            <div
                class="bg-light-gray p-8 rounded-xl text-left border-t-4 border-rescue-red shadow-sm hover:shadow-md transition-shadow">
                <div class="text-6xl font-black text-rescue-red/20 leading-none mb-4">03</div>
                <h3 class="text-2xl font-bold mb-3 text-charcoal">Ambulans Meluncur</h3>
                <p class="text-gray-600 leading-relaxed font-medium">Tim medis profesional beserta armada dengan
                    peralatan lengkap langsung bergerak menuju lokasi Anda.</p>
            </div>
        </div>
    </section>

    <!-- 4. Footer (Kontak Darurat Tetap Terlihat & SEO Teks LSI) -->
    <footer class="bg-charcoal text-white pt-20 pb-12 px-6 text-center">
        <div class="max-w-4xl mx-auto mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4 tracking-tight">Area Jangkauan Seluruh Kota</h2>
            <p class="text-gray-400 mb-8 max-w-2xl mx-auto font-medium">Membutuhkan penanganan instan? Operator kami
                sedia menjawab panggilan darurat medis Anda dalam hitungan detik. Kesiagaan adalah prioritas kami.</p>
            <!-- Nomor Telpon Menonjol -->
            <a href="tel:112"
                class="text-4xl md:text-6xl font-black text-rescue-red hover:text-white transition-colors duration-300 block mb-6">
                112 / 0811-XXXX
            </a>
        </div>
        <div class="border-t border-gray-700/50 pt-8 mt-8">
            <p class="text-sm text-gray-500 font-medium">Hak Cipta &copy; 2026 Medzone Emergency Service.</p>
        </div>
    </footer>

    <!-- 5. Floating Action Button (FAB) Mobile-First Paling Krusial -->
    <!-- Tombol ini cuma muncul di Mobile (md:hidden) dan nempel menimpa elemen lain (fixed pointer z-50) -->
    <a href="tel:112" aria-label="Panggil Ambulans Darurat"
        class="md:hidden fixed bottom-6 right-6 bg-rescue-red text-white w-16 h-16 rounded-full flex items-center justify-center text-3xl shadow-[0_4px_15px_rgba(215,38,61,0.5)] animate-pulse-custom z-50 hover:bg-[#b01c30]">
        📞
    </a>

</body>

</html>