<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Tim Lapangan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold">Halo, {{ Auth::user()->name }}!</h3>
                    @if($ambulance)
                        <p class="mt-2">Armada Anda: <strong>{{ $ambulance->name }}</strong> ({{ $ambulance->plat_number }})</p>
                        <div class="mt-4">
                            Status Saat Ini: 
                            <span class="px-3 py-1 rounded text-white {{ $ambulance->status == 'ready' ? 'bg-green-500' : ($ambulance->status == 'busy' ? 'bg-red-500' : 'bg-gray-500') }}">
                                {{ strtoupper($ambulance->status) }}
                            </span>
                        </div>
                    @else
                        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mt-4">
                            <p>⚠️ Akun Anda belum terhubung dengan mobil ambulan manapun. Hubungi Admin.</p>
                        </div>
                    @endif
                </div>
            </div>

            @if($activeJob)
            <div class="bg-red-50 border-2 border-red-500 overflow-hidden shadow-xl sm:rounded-lg animate-pulse">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-2xl font-bold text-red-700">🚨 TUGAS DARURAT MASUK!</h3>
                        <span class="text-sm text-gray-500">{{ $activeJob->created_at->diffForHumans() }}</span>
                    </div>
                    
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-600 font-semibold">Keterangan Kejadian:</p>
                            <p class="text-xl font-bold">{{ $activeJob->description }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-semibold">Lokasi Pasien:</p>
                            <p>Lat: {{ $activeJob->latitude }}, Lng: {{ $activeJob->longitude }}</p>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col md:flex-row gap-4">
                        <a href="https://www.google.com/maps/dir/?api=1&destination={{ $activeJob->latitude }},{{ $activeJob->longitude }}" target="_blank" 
                           class="flex-1 bg-blue-600 hover:bg-blue-800 text-white text-center font-bold py-4 px-6 rounded-lg text-lg">
                           🗺️ BUKA NAVIGASI GOOGLE MAPS
                        </a>
                        
                        <form action="{{ route('lapangan.finishJob', $activeJob->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" onclick="return confirm('Yakin pasien sudah sampai ke Rumah Sakit?');"
                                    class="w-full bg-green-600 hover:bg-green-800 text-white font-bold py-4 px-6 rounded-lg text-lg transition duration-300">
                                    ✅ PASIEN SUDAH DIANTAR
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @else
            <div class="bg-green-50 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 text-center">
                    <h3 class="text-xl text-gray-500">Tidak ada tugas aktif. Standby di Basecamp.</h3>
                    <p class="text-4xl mt-4">☕</p>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>