<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Section -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
                <div>
                    <h2 class="text-3xl font-black text-gray-800">
                        <span class="text-teal-600">Call</span> Center
                    </h2>
                    <p class="text-gray-500 mt-1">Monitoring operasional armada dan panggilan darurat real-time.</p>
                </div>
                <div class="bg-white px-4 py-2 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-3">
                    <div class="p-2 bg-teal-50 rounded-xl text-teal-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="text-sm font-bold text-gray-700">
                        {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                    </div>
                </div>
            </div>

            <!-- NEW: Menu Grid (Sesuai Flowchart) -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-12">
                <!-- Menu 1: Input Jadwal -->
                <a href="{{ route('operator.schedules.index') }}"
                    class="group bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-lg hover:border-teal-200 transition-all text-center">
                    <div
                        class="w-14 h-14 mx-auto bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-4 group-hover:scale-110 transition">
                        <i class="fas fa-calendar-alt text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 group-hover:text-blue-600 transition">Input Jadwal</h3>
                    <p class="text-xs text-slate-400 mt-1">Shift Driver & Nakes</p>
                </a>

                <!-- Menu 2: Rekap Pasien -->
                <a href="{{ route('operator.reports.index') }}"
                    class="group bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-lg hover:border-teal-200 transition-all text-center">
                    <div
                        class="w-14 h-14 mx-auto bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 mb-4 group-hover:scale-110 transition">
                        <i class="fas fa-file-medical-alt text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 group-hover:text-purple-600 transition">Rekap Pasien</h3>
                    <p class="text-xs text-slate-400 mt-1">Laporan & Histori</p>
                </a>

                <!-- Menu 3: Ambulan Swasta -->
                <a href="{{ route('operator.ambulances.private') }}"
                    class="group bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-lg hover:border-teal-200 transition-all text-center">
                    <div
                        class="w-14 h-14 mx-auto bg-orange-50 rounded-2xl flex items-center justify-center text-orange-600 mb-4 group-hover:scale-110 transition">
                        <i class="fas fa-ambulance text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 group-hover:text-orange-600 transition">Ambulan Swasta</h3>
                    <p class="text-xs text-slate-400 mt-1">Kelola Unit Luar</p>
                </a>

                <!-- Menu 4: Hubungi Driver -->
                <a href="{{ route('operator.contacts.index') }}"
                    class="group bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-lg hover:border-teal-200 transition-all text-center">
                    <div
                        class="w-14 h-14 mx-auto bg-green-50 rounded-2xl flex items-center justify-center text-green-600 mb-4 group-hover:scale-110 transition">
                        <i class="fas fa-phone-alt text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 group-hover:text-green-600 transition">Hubungi Driver</h3>
                    <p class="text-xs text-slate-400 mt-1">Kontak Cepat</p>
                </a>
            </div>

            <!-- Top Grid: Status & Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <!-- Card 1: Panggilan Aktif -->
                <div
                    class="bg-white rounded-[2rem] p-8 shadow-sm hover:shadow-lg transition duration-300 border border-gray-100 group relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-24 h-24 bg-red-50 rounded-bl-[100%] transition-all group-hover:scale-150 duration-500">
                    </div>
                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">Panggilan Aktif</p>
                                <h4 class="text-5xl font-black text-gray-800 mt-2 group-hover:text-red-600 transition">
                                    {{ $emergencies->where('status', '!=', 'completed')->count() }}
                                </h4>
                            </div>
                            <div class="p-4 bg-red-100 rounded-3xl text-red-600">
                                <i class="fas fa-phone-volume text-2xl"></i>
                            </div>
                        </div>
                        <p class="text-sm font-medium text-red-500 flex items-center gap-2">
                            <span class="flex w-2 h-2 bg-red-600 rounded-full animate-pulse"></span>
                            Membutuhkan Penanganan
                        </p>
                    </div>
                </div>

                <!-- Card 2: Status Armada -->
                <div
                    class="bg-white rounded-[2rem] p-8 shadow-sm hover:shadow-lg transition duration-300 border border-gray-100 group relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-24 h-24 bg-green-50 rounded-bl-[100%] transition-all group-hover:scale-150 duration-500">
                    </div>
                    <div class="relative z-10 w-full">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="p-3 bg-green-100 rounded-2xl text-green-600">
                                <i class="fas fa-shipping-fast text-xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Status Armada</h3>
                        </div>
                        <div class="space-y-3">
                            @foreach($ambulances->take(3) as $amb)
                                                    <div class="flex justify-between items-center bg-gray-50 p-3 rounded-2xl">
                                                        <span class="font-bold text-gray-700 text-sm">{{ $amb->name }}</span>
                                                        <span
                                                            class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider
                                                                {{ $amb->status == 'ready' ? 'bg-green-200 text-green-800' :
                                ($amb->status == 'busy' ? 'bg-red-200 text-red-800' : 'bg-gray-200 text-gray-600') }}">
                                                            {{ $amb->status }}
                                                        </span>
                                                    </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Card 3: Bed RS (Scrollable) -->
                <div
                    class="bg-white rounded-[2rem] p-8 shadow-sm hover:shadow-lg transition duration-300 border border-gray-100 group relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-bl-[100%] transition-all group-hover:scale-150 duration-500">
                    </div>
                    <div class="relative z-10 w-full h-full flex flex-col">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="p-3 bg-blue-100 rounded-2xl text-blue-600">
                                <i class="fas fa-procedures text-xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Ketersediaan Bed</h3>
                        </div>
                        <div class="overflow-y-auto max-h-[160px] pr-2 space-y-3 custom-scrollbar">
                            @foreach($hospitals as $rs)
                                <div
                                    class="flex justify-between items-center bg-gray-50 p-3 rounded-2xl border-l-4 border-blue-400">
                                    <span class="font-medium text-gray-700 text-xs truncate w-2/3">{{ $rs->name }}</span>
                                    <span class="font-black text-blue-600 text-sm">{{ $rs->available_bed_igd }} Bed</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main List: Emergency Calls -->
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h3 class="text-2xl font-black text-gray-800">📞 Daftar Panggilan Darurat</h3>
                        <p class="text-sm text-gray-500">Kelola dan tugaskan ambulan untuk setiap panggilan.</p>
                    </div>
                    <span
                        class="px-5 py-2 bg-teal-50 text-teal-700 rounded-2xl font-bold text-sm border border-teal-100">
                        Today: {{ $emergencies->count() }} Calls
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b border-gray-100">
                                <th class="pb-4 pl-4">Waktu</th>
                                <th class="pb-4">Pelapor</th>
                                <th class="pb-4">Lokasi Kejadian</th>
                                <th class="pb-4">Status</th>
                                <th class="pb-4">Ambulan</th>
                                <th class="pb-4 pr-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($emergencies as $emergency)
                                <tr class="hover:bg-gray-50 transition duration-200 group">
                                    <td class="py-5 pl-4 font-mono text-sm text-gray-500">
                                        {{ $emergency->created_at->format('H:i') }}
                                    </td>
                                    <td class="py-5">
                                        <div class="font-bold text-gray-800 group-hover:text-teal-600 transition">
                                            {{ $emergency->user->name ?? 'Anonim' }}
                                        </div>
                                        <div class="text-xs text-gray-400">{{ $emergency->user->phone_number ?? '-' }}</div>
                                    </td>
                                    <td class="py-5">
                                        <div
                                            class="max-w-xs truncate text-sm text-gray-600 bg-gray-50 px-3 py-1 rounded-xl">
                                            {{ $emergency->address ?? 'Lokasi via GPS' }}
                                        </div>
                                    </td>
                                    <td class="py-5">
                                        @php
                                            $badgeClass = match ($emergency->status) {
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'process' => 'bg-blue-100 text-blue-800',
                                                'completed' => 'bg-green-100 text-green-800',
                                                'cancelled' => 'bg-red-100 text-red-800',
                                                default => 'bg-gray-100 text-gray-800'
                                            };
                                        @endphp
                                        <span class="px-3 py-1 rounded-full text-xs font-black uppercase {{ $badgeClass }}">
                                            {{ ucfirst($emergency->status) }}
                                        </span>
                                    </td>
                                    <td class="py-5">
                                        @if($emergency->ambulance)
                                            <div class="flex items-center gap-2">
                                                <div class="w-2 h-2 rounded-full bg-teal-500"></div>
                                                <span
                                                    class="font-bold text-gray-700 text-sm">{{ $emergency->ambulance->name }}</span>
                                            </div>
                                        @else
                                            <span class="text-gray-400 text-xs italic">- Belum assigned -</span>
                                        @endif
                                    </td>
                                    <td class="py-5 pr-4 text-right">
                                        @if($emergency->status == 'pending')
                                            <form action="{{ route('operator.emergency.assign', $emergency->id) }}"
                                                method="POST" class="inline-flex items-center gap-2">
                                                @csrf
                                                <select name="ambulance_id"
                                                    class="text-xs border-gray-200 bg-gray-50 rounded-xl focus:ring-teal-500 py-2"
                                                    required>
                                                    <option value="">Pilih Unit...</option>
                                                    @foreach($ambulances as $amb)
                                                        @if($amb->status == 'ready' || $amb->status == 'busy')
                                                            <option value="{{ $amb->id }}">{{ $amb->name }} ({{ $amb->status }})
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <button type="submit"
                                                    class="bg-teal-600 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-teal-700 shadow-md hover:shadow-lg transition">
                                                    Dispatch
                                                </button>
                                            </form>
                                        @else
                                            <div class="flex items-center justify-end gap-2">
                                                <button class="text-blue-600 font-bold text-xs hover:underline">Detail</button>
                                                @if($emergency->status != 'completed' && $emergency->status != 'cancelled')
                                                    <form action="{{ route('operator.emergency.cancel', $emergency->id) }}"
                                                        method="POST" onsubmit="return confirm('Batalkan?')">
                                                        @csrf
                                                        <button type="submit"
                                                            class="w-8 h-8 rounded-full bg-red-50 text-red-500 hover:bg-red-100 flex items-center justify-center transition">
                                                            <i class="fas fa-times text-xs"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div
                                                class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                                <i class="fas fa-phone-slash text-3xl text-gray-300"></i>
                                            </div>
                                            <p class="text-gray-400 font-medium">Belum ada panggilan darurat hari ini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            // Auto-refresh halaman setiap 30 detik
            setTimeout(function () {
                window.location.reload(1);
            }, 30000);
        </script>
    @endpush
    <style>
        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</x-app-layout>