<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center w-full">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                <span class="text-blue-600">Dashboard</span> Monitoring Operasional
            </h2>
            <div class="mt-2 md:mt-0 text-sm text-gray-500 text-right">
                {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Welcome Banner (Modern Gradient) -->
            <div
                class="relative overflow-hidden rounded-[2rem] bg-gradient-to-r from-blue-600 to-rose-700 shadow-xl shadow-teal-900/10 p-8 text-white">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full -mr-16 -mt-16 blur-2xl">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-40 h-40 bg-teal-400 opacity-20 rounded-full -ml-10 -mb-10 blur-xl">
                </div>

                <div class="relative z-10 flex justify-between items-center">
                    <div>
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-800/30 border border-rose-400/30 backdrop-blur-md text-blue-50 text-xs font-semibold tracking-wide mb-3">
                            <i class="fas fa-chart-line"></i> SYSTEM MONITORING
                        </div>
                        <h3 class="text-3xl font-bold mb-1">Selamat Datang, {{ Auth::user()->name }}! 👋</h3>
                        <p class="text-teal-100/90 text-lg">Pantau operasional SPGDT dan ketersediaan fasilitas
                            kesehatan secara real-time.</p>
                    </div>
                    <div class="hidden md:block">
                        <i class="fas fa-user-md text-8xl text-white opacity-20"></i>
                    </div>
                </div>
            </div>

            <!-- Stats Cards (SOS Theme) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Calls Today -->
                <div
                    class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-lg hover:border-blue-200 transition-all duration-300 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-500 text-sm font-bold uppercase tracking-wider">Kejadian Hari Ini</p>
                            <h4 class="text-4xl font-black text-slate-800 mt-2 group-hover:text-blue-600 transition">
                                {{ $stats['total_calls_today'] }}
                            </h4>
                        </div>
                        <div
                            class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 text-2xl group-hover:scale-110 transition duration-300">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Calls -->
                <div
                    class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-lg hover:border-purple-200 transition-all duration-300 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-500 text-sm font-bold uppercase tracking-wider">Total Kejadian</p>
                            <h4 class="text-4xl font-black text-slate-800 mt-2 group-hover:text-purple-600 transition">
                                {{ $stats['total_calls'] }}
                            </h4>
                        </div>
                        <div
                            class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 text-2xl group-hover:scale-110 transition duration-300">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                    </div>
                </div>

                <!-- Active Ambulances -->
                <div
                    class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-lg hover:border-green-200 transition-all duration-300 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-500 text-sm font-bold uppercase tracking-wider">Ambulan On Duty</p>
                            <h4 class="text-4xl font-black text-slate-800 mt-2 group-hover:text-green-600 transition">
                                {{ $stats['active_ambulances'] }}
                            </h4>
                        </div>
                        <div
                            class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 text-2xl group-hover:scale-110 transition duration-300">
                            <i class="fas fa-ambulance"></i>
                        </div>
                    </div>
                </div>

                <!-- Available Ambulances -->
                <div
                    class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-lg hover:border-amber-200 transition-all duration-300 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-500 text-sm font-bold uppercase tracking-wider">Ambulan Tersedia</p>
                            <h4 class="text-4xl font-black text-slate-800 mt-2 group-hover:text-amber-600 transition">
                                {{ $stats['available_ambulances'] }}
                            </h4>
                        </div>
                        <div
                            class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 text-2xl group-hover:scale-110 transition duration-300">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Emergency Calls & Chart -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Calls -->
                <div
                    class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden flex flex-col h-full">
                    <div class="p-6 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                        <h3 class="font-bold text-lg text-slate-800 flex items-center gap-2">
                            <i class="fas fa-history text-slate-400"></i> Kejadian Terbaru
                        </h3>
                        <a href="#" class="text-sm font-bold text-teal-600 hover:underline">Lihat Semua</a>
                    </div>

                    <div class="flex-1 p-2 space-y-2">
                        @if($recentCalls->isEmpty())
                            <div class="flex flex-col items-center justify-center h-40 text-slate-400 gap-2">
                                <i class="fas fa-clipboard-check text-4xl opacity-20"></i>
                                <p class="text-sm font-medium">Belum ada kejadian darurat</p>
                            </div>
                        @else
                            @foreach($recentCalls as $call)
                                            <div
                                                class="group p-4 rounded-2xl hover:bg-slate-50 transition border border-transparent hover:border-slate-100">
                                                <div class="flex justify-between items-start">
                                                    <div class="flex items-start gap-4">
                                                        <div
                                                            class="w-10 h-10 rounded-full flex items-center justify-center shrink-0
                                                                                                                                                                                                                                                                            {{ $call->status == 'completed' ? 'bg-green-100 text-green-600' :
                                ($call->status == 'on_going' ? 'bg-blue-100 text-blue-600' : 'bg-red-100 text-red-600') }}">
                                                            <i
                                                                class="fas {{ $call->status == 'completed' ? 'fa-check' : ($call->status == 'on_going' ? 'fa-ambulance' : 'fa-exclamation') }}"></i>
                                                        </div>
                                                        <div>
                                                            <p class="font-bold text-slate-800">{{ $call->user->name }}</p>
                                                            <p class="text-xs text-slate-500 mt-1 flex items-center gap-1">
                                                                <i class="fas fa-map-marker-alt"></i> {{ Str::limit($call->location, 35) }}
                                                            </p>
                                                            <p
                                                                class="text-xs font-medium text-slate-600 mt-2 bg-slate-100 px-2 py-1 rounded inline-block">
                                                                🚑 {{ $call->ambulance->name ?? 'Menunggu Assignment' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <span
                                                            class="px-3 py-1 text-[10px] font-bold uppercase tracking-wider rounded-full 
                                                                                                                                                                                                                                                                            @if($call->status == 'completed') bg-green-50 text-green-700 border border-green-100
                                                                                                                                                                                                                                                                            @elseif($call->status == 'on_going') bg-blue-50 text-blue-700 border border-blue-100
                                                                                                                                                                                                                                                                            @else bg-slate-50 text-slate-700 border border-slate-100 @endif">
                                                            {{ ucfirst($call->status) }}
                                                        </span>
                                                        <p class="text-[10px] text-slate-400 mt-1 font-medium">
                                                            {{ $call->created_at->diffForHumans() }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Chart Placeholder -->
                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8 flex flex-col justify-center">
                    <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                        <i class="fas fa-chart-bar text-teal-500"></i> Tren 7 Hari Terakhir
                    </h3>

                    <div class="space-y-5">
                        @forelse($chartData as $data)
                            <div class="flex items-center gap-4 group">
                                <div class="w-24 text-xs font-bold text-slate-500 text-right">
                                    {{ \Carbon\Carbon::parse($data->date)->format('d M') }}
                                </div>
                                <div class="flex-1 bg-slate-100 rounded-full h-3 overflow-hidden">
                                    <div class="bg-gradient-to-r from-teal-400 to-teal-600 h-full rounded-full flex items-center justify-end group-hover:scale-x-105 transition-transform origin-left duration-500 ease-out"
                                        style="width: {{ $data->total > 0 ? ($data->total / max($chartData->max('total'), 1) * 100) : 0 }}%">
                                    </div>
                                </div>
                                <div class="w-6 text-sm font-bold text-slate-700">{{ $data->total }}</div>
                            </div>
                        @empty
                            <div class="text-center text-slate-400 py-10">
                                <i class="fas fa-chart-area text-4xl opacity-20 mb-2"></i>
                                <p>Tidak ada data</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Resource Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div
                    class="bg-white p-8 rounded-[2rem] shadow-none border border-slate-200 flex items-center justify-between hover:border-blue-300 transition group">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800 mb-1">Rumah Sakit Rujukan</h3>
                        <p class="text-sm text-slate-500">Total RS terdaftar di sistem</p>
                    </div>
                    <div class="text-right">
                        <p class="text-5xl font-black text-blue-600 group-hover:scale-110 transition duration-300">
                            {{ $stats['total_hospitals'] }}
                        </p>
                    </div>
                </div>

                <div
                    class="bg-white p-8 rounded-[2rem] shadow-none border border-slate-200 flex items-center justify-between hover:border-green-300 transition group">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800 mb-1">Puskesmas / Basecamp</h3>
                        <p class="text-sm text-slate-500">Titik siaga ambulan</p>
                    </div>
                    <div class="text-right">
                        <p class="text-5xl font-black text-green-600 group-hover:scale-110 transition duration-300">
                            {{ $stats['total_basecamps'] }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>