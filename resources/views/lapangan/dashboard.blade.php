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

            @if(isset($activeJob) && $activeJob)
            <div class="bg-red-50 border-2 border-red-500 overflow-hidden shadow-xl sm:rounded-lg mb-6 animate-pulse">
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
                            <p class="font-bold mt-1 text-lg">{{ $activeJob->location }}</p>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col md:flex-row gap-4">
                        <a href="https://www.google.com/maps/dir/?api=1&destination={{ $activeJob->latitude }},{{ $activeJob->longitude }}" target="_blank" 
                           class="flex-1 bg-blue-600 hover:bg-blue-800 text-white text-center font-bold py-4 px-6 rounded-lg text-lg shadow-lg">
                            🗺️ NAVIGASI GOOGLE MAPS
                        </a>
                        
                        <form action="{{ route('lapangan.finish', $activeJob->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" onclick="return confirm('Yakin pasien sudah sampai ke Rumah Sakit?');"
                                    class="w-full bg-green-600 hover:bg-green-800 text-white font-bold py-4 px-6 rounded-lg text-lg transition duration-300 shadow-lg">
                                ✅ PASIEN SUDAH DIANTAR
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 mt-6">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">🏥 Rekomendasi RS Rujukan (Real-Time)</h3>
                    <p class="text-sm text-gray-500 mb-4">Urutan berdasarkan ketersediaan Bed IGD terbanyak.</p>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto text-sm w-full text-left">
                            <thead class="bg-gray-100 uppercase text-gray-600 font-medium font-sans">
                                <tr>
                                    <th class="px-4 py-3">Nama Rumah Sakit</th>
                                    <th class="px-4 py-3 text-center">IGD Kosong</th>
                                    <th class="px-4 py-3 text-center">ICU Kosong</th>
                                    <th class="px-4 py-3 text-center">Telepon</th>
                                    <th class="px-4 py-3 text-center">Rute</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 font-light">
                                @forelse($hospitals as $rs)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 font-bold text-gray-800">
                                        {{ $rs->name }}
                                        <div class="text-xs font-normal text-gray-500">{{ $rs->address }}</div>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if($rs->available_bed_igd > 0)
                                            <span class="bg-green-100 text-green-800 py-1 px-3 rounded-full text-xs font-bold">
                                                {{ $rs->available_bed_igd }} Bed
                                            </span>
                                        @else
                                            <span class="bg-red-100 text-red-800 py-1 px-3 rounded-full text-xs font-bold">PENUH</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center font-bold">
                                        {{ $rs->available_bed_icu }}
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <a href="tel:{{ $rs->phone_igd }}" class="text-blue-600 font-bold hover:underline">{{ $rs->phone_igd }}</a>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <a href="https://www.google.com/maps/dir/?api=1&destination={{ $rs->latitude }},{{ $rs->longitude }}" target="_blank" 
                                           class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded text-xs font-bold">
                                            Rute ↗
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-gray-500">Data RS belum tersedia.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
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