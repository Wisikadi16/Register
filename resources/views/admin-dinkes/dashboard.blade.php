<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-3xl font-black text-charcoal tracking-tight">
                    Dashboard <span class="text-blue-600 font-semibold">Admin Dinkes</span>
                </h2>
                <p class="text-slate-500 font-medium mt-1">Sistem Peringatan Terpadu & Laporan SPGDT</p>
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

            {{-- WELCOME BANNER (Minimalist & Premium) --}}
            <div
                class="bg-gradient-to-r from-rescue-red to-red-600 p-8 md:p-10 shadow-lg flex flex-col md:flex-row items-center justify-between gap-8 relative overflow-hidden group">
                <div
                    class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full blur-3xl opacity-10 -translate-y-1/2 translate-x-1/2 pattern-grid-lg text-white">
                </div>

                <div class="relative z-10 max-w-2xl text-center md:text-left">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white/20 border border-white/20 text-white text-[10px] font-black uppercase tracking-widest mb-4 shadow-sm backdrop-blur-sm">
                        <i class="fas fa-chart-line text-white"></i> Monitoring Pusat
                    </div>
                    <h1 class="text-3xl md:text-4xl font-black text-white tracking-tight mb-2">
                        Halo, {{ Auth::user()->name }} 👋
                    </h1>
                    <p class="text-red-50 text-base leading-relaxed">
                        Ringkasan eksekutif ketersediaan armada Ambulan Hebat (SPGDT) dan statistik laporan
                        kegawatdaruratan real-time untuk optimalisasi fasilitas.
                    </p>
                </div>

                <div
                    class="relative z-10 hidden md:flex w-32 h-32 bg-white/20 border border-white/20 rounded-[2rem] shadow-inner items-center justify-center text-white/70 text-6xl group-hover:scale-105 group-hover:-rotate-3 transition duration-700 backdrop-blur-sm">
                    <i class="fas fa-building text-white"></i>
                </div>
            </div>

            <!-- Stats Cards (Sleek Minimalist) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Kejadian Hari Ini -->
                <div
                    class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-lg hover:-translate-y-1 hover:border-blue-300 transition-all duration-300 group flex flex-col justify-between relative overflow-hidden">
                    <div
                        class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300 shadow-sm z-10 relative">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="z-10 relative">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Kejadian Hari Ini
                        </p>
                        <h4 class="text-4xl font-black text-charcoal group-hover:text-blue-600 transition-colors">
                            {{ $stats['total_calls_today'] }}
                        </h4>
                    </div>
                    <i
                        class="fas fa-exclamation absolute -right-4 -bottom-4 text-7xl text-slate-50 opacity-40 transform rotate-12 group-hover:rotate-0 transition duration-700"></i>
                </div>

                <!-- Total Kejadian -->
                <div
                    class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-lg hover:-translate-y-1 hover:border-purple-300 transition-all duration-300 group flex flex-col justify-between relative overflow-hidden">
                    <div
                        class="w-14 h-14 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center text-2xl mb-4 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300 shadow-sm z-10 relative">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="z-10 relative">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Semua Kejadian
                        </p>
                        <h4 class="text-4xl font-black text-charcoal group-hover:text-purple-600 transition-colors">
                            {{ $stats['total_calls'] }}
                        </h4>
                    </div>
                    <i
                        class="fas fa-phone absolute -right-4 -bottom-4 text-7xl text-slate-50 opacity-40 transform rotate-12 group-hover:rotate-0 transition duration-700"></i>
                </div>

                <!-- Active Ambulances -->
                <div
                    class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-lg hover:-translate-y-1 hover:border-amber-300 transition-all duration-300 group flex flex-col justify-between relative overflow-hidden">
                    <div
                        class="w-14 h-14 bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center text-2xl mb-4 group-hover:bg-amber-500 group-hover:text-white transition-colors duration-300 shadow-sm z-10 relative">
                        <i class="fas fa-ambulance"></i>
                    </div>
                    <div class="z-10 relative">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Ambulan Operasi
                        </p>
                        <h4 class="text-4xl font-black text-charcoal group-hover:text-amber-500 transition-colors">
                            {{ $stats['active_ambulances'] }}
                        </h4>
                    </div>
                    <i
                        class="fas fa-truck-medical absolute -right-4 -bottom-4 text-7xl text-slate-50 opacity-40 transform -rotate-12 group-hover:rotate-0 transition duration-700"></i>
                </div>

                <!-- Available Ambulances -->
                <div
                    class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-lg hover:-translate-y-1 hover:border-teal-300 transition-all duration-300 group flex flex-col justify-between relative overflow-hidden">
                    <div
                        class="w-14 h-14 bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center text-2xl mb-4 group-hover:bg-teal-600 group-hover:text-white transition-colors duration-300 shadow-sm z-10 relative">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="z-10 relative">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Ambulan Tersedia
                        </p>
                        <h4 class="text-4xl font-black text-charcoal group-hover:text-teal-600 transition-colors">
                            {{ $stats['available_ambulances'] }}
                        </h4>
                    </div>
                    <i
                        class="fas fa-check absolute -right-4 -bottom-4 text-7xl text-slate-50 opacity-40 transform rotate-12 group-hover:rotate-0 transition duration-700"></i>
                </div>
            </div>

            <!-- Recent Emergency Calls & Chart Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <!-- Recent Calls (Minimalist List) -->
                <div
                    class=<div class="bg-white border border-gray-100 p-8 md:p-10 shadow-md relative overflow-hidden flex items-center justify-between group">
                    <div class="p-8 pb-4 flex justify-between items-center bg-white">
                        <h3 class="font-black text-xl text-charcoal flex items-center gap-3">
                            Kejadian Terbaru
                        </h3>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-blue-50 hover:text-blue-600 transition shadow-sm active:scale-95">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <div class="flex-1 p-6 pt-2 space-y-3 overflow-y-auto max-h-[400px] custom-scrollbar">
                        @forelse($recentCalls as $call)
                                            <div
                                                class="group bg-slate-50 hover:bg-white border border-transparent hover:border-slate-200 p-5 rounded-2xl transition duration-300 flex flex-col sm:flex-row sm:items-center justify-between gap-4 shadow-sm hover:shadow-md">
                                                <div class="flex items-start sm:items-center gap-4">
                                                    <div
                                                        class="w-12 h-12 rounded-xl flex items-center justify-center text-xl shrink-0 border border-slate-100/50 shadow-sm
                                                            {{ $call->status == 'completed' ? 'bg-teal-50 text-teal-600' :
                            ($call->status == 'on_going' ? 'bg-amber-50 text-amber-600' : 'bg-red-50 text-rescue-red') }}">
                                                        @if($call->status == 'completed') <i class="fas fa-check"></i>
                                                        @elseif($call->status == 'on_going') <i class="fas fa-ambulance"></i>
                                                        @else <i class="fas fa-exclamation"></i>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <h4
                                                            class="font-bold text-charcoal text-sm mb-1 group-hover:text-blue-600 transition">
                                                            {{ $call->user->name ?? 'Pelapor Anonim' }}
                                                        </h4>
                                                        <div
                                                            class="flex flex-col gap-1 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                                                            <span class="flex items-center gap-1.5"><i
                                                                    class="fas fa-map-marker-alt text-slate-300"></i>
                                                                {{ Str::limit($call->location, 35) }}</span>
                                                            <span class="flex items-center gap-1.5 text-blue-500 mt-1 capitalize"><i
                                                                    class="fas fa-truck-medical"></i>
                                                                {{ $call->ambulance->name ?? 'Menunggu Assignment' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="self-end sm:self-center text-right flex flex-col items-end gap-2">
                                                    <span
                                                        class="px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm
                                                            {{ $call->status == 'completed' ? 'bg-teal-50 text-teal-600 border border-teal-100' :
                            ($call->status == 'on_going' ? 'bg-amber-50 text-amber-600 border border-amber-100' : 'bg-red-50 text-rescue-red border border-red-100') }}">
                                                        {{ ucfirst($call->status) }}
                                                    </span>
                                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                                        {{ $call->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                        @empty
                            <div class="flex flex-col items-center justify-center py-16 text-slate-400 text-center">
                                <div
                                    class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 text-slate-200 text-4xl shadow-inner border border-slate-100">
                                    <i class="fas fa-bed"></i>
                                </div>
                                <p class="font-bold text-charcoal mb-1">Tidak Ada Kejadian</p>
                                <p class="text-sm">Pantauan darurat saat ini aman terkendali.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Chart (Sleek Bar Line) -->
                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8 flex flex-col justify-center">
                    <h3 class="font-black text-xl text-charcoal mb-8 flex items-center gap-3">
                        Statistik 7 Hari Terakhir
                    </h3>

                    <div class="space-y-6">
                        @forelse($chartData as $data)
                            <div class="flex items-center gap-4 group">
                                <div class="w-20 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">
                                    {{ \Carbon\Carbon::parse($data->date)->format('d M') }}
                                </div>
                                <div
                                    class="flex-1 bg-slate-50 rounded-full h-4 overflow-hidden shadow-inner border border-slate-100">
                                    <div class="bg-charcoal h-full rounded-full flex items-center justify-end group-hover:bg-blue-600 transition-colors duration-500 ease-out relative"
                                        style="width: {{ $data->total > 0 ? ($data->total / max($chartData->max('total'), 1) * 100) : 0 }}%">
                                    </div>
                                </div>
                                <div
                                    class="w-8 text-sm font-black text-charcoal text-left group-hover:text-blue-600 transition-colors">
                                    {{ $data->total }}</div>
                            </div>
                        @empty
                            <div class="text-center text-slate-400 py-10">
                                <div
                                    class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 text-slate-200 text-4xl mx-auto shadow-inner border border-slate-100">
                                    <i class="fas fa-chart-area"></i>
                                </div>
                                <p class="font-bold text-charcoal">Data Belum Tersedia</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Resource Setup Summary -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div
                    class="bg-charcoal p-8 rounded-[2rem] shadow-xl flex items-center justify-between text-white relative overflow-hidden group">
                    <div
                        class="absolute -right-4 -bottom-4 w-32 h-32 border-[6px] border-slate-700/50 rounded-full group-hover:scale-110 transition duration-700">
                    </div>
                    <div class="relative z-10">
                        <h3 class="text-lg font-bold text-white mb-2">Total Referensi RS</h3>
                        <p class="text-sm font-medium text-slate-400 max-w-xs leading-relaxed">Fasilitas kesehatan yang
                            terdaftar sebagai tujuan rujukan pasien.</p>
                    </div>
                    <div class="relative z-10 text-right">
                        <p
                            class="text-6xl font-black text-blue-400 drop-shadow-md group-hover:-translate-y-1 transition-transform duration-300">
                            {{ $stats['total_hospitals'] }}
                        </p>
                    </div>
                </div>

                <div
                    class="bg-charcoal p-8 rounded-[2rem] shadow-xl flex items-center justify-between text-white relative overflow-hidden group">
                    <div
                        class="absolute -right-4 -bottom-4 w-32 h-32 border-[6px] border-slate-700/50 rounded-full group-hover:scale-110 transition duration-700">
                    </div>
                    <div class="relative z-10">
                        <h3 class="text-lg font-bold text-white mb-2">Puskesmas Siaga</h3>
                        <p class="text-sm font-medium text-slate-400 max-w-xs leading-relaxed">Titik lokasi basecamp
                            penyebaran armada darurat medis.</p>
                    </div>
                    <div class="relative z-10 text-right">
                        <p
                            class="text-6xl font-black text-teal-400 drop-shadow-md group-hover:-translate-y-1 transition-transform duration-300">
                            {{ $stats['total_basecamps'] }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>