<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center w-full">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                <span class="text-teal-600">Dashboard</span> Monitoring Operasional
            </h2>
            <div class="mt-2 md:mt-0 text-sm text-gray-500 text-right">
                {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-teal-600 to-cyan-700 rounded-lg shadow-lg p-6 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-bold">Selamat Datang, {{ Auth::user()->name }}! 👋</h3>
                        <p class="text-teal-100 mt-2">Admin Dinas Kesehatan - Monitoring Real-time Sistem SPGDT</p>
                    </div>
                    <div class="hidden md:block text-6xl opacity-20">📊</div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Calls Today -->
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Kejadian Hari Ini</p>
                            <h4 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['total_calls_today'] }}</h4>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <span class="text-2xl">🚨</span>
                        </div>
                    </div>
                </div>

                <!-- Total Calls -->
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Kejadian</p>
                            <h4 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['total_calls'] }}</h4>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-full">
                            <span class="text-2xl">📞</span>
                        </div>
                    </div>
                </div>

                <!-- Active Ambulances -->
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Ambulan On Duty</p>
                            <h4 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['active_ambulances'] }}</h4>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <span class="text-2xl">🚑</span>
                        </div>
                    </div>
                </div>

                <!-- Available Ambulances -->
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-amber-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Ambulan Tersedia</p>
                            <h4 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['available_ambulances'] }}</h4>
                        </div>
                        <div class="bg-amber-100 p-3 rounded-full">
                            <span class="text-2xl">✅</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Emergency Calls & Chart -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Calls -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">📋 Kejadian Terbaru</h3>

                    @if($recentCalls->isEmpty())
                        <p class="text-gray-500 text-center py-8">Belum ada kejadian darurat</p>
                    @else
                        <div class="space-y-3">
                            @foreach($recentCalls as $call)
                                <div class="border-l-4 border-teal-500 bg-gray-50 p-3 rounded">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <p class="font-semibold text-gray-800">{{ $call->user->name }}</p>
                                            <p class="text-sm text-gray-600 mt-1">📍 {{ Str::limit($call->location, 40) }}</p>
                                            <p class="text-xs text-gray-500 mt-1">
                                                🚑 {{ $call->ambulance->name ?? 'Belum ditugaskan' }}
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                                        @if($call->status == 'completed') bg-green-100 text-green-800
                                                        @elseif($call->status == 'on_going') bg-blue-100 text-blue-800
                                                        @else bg-gray-100 text-gray-800 @endif">
                                                {{ ucfirst($call->status) }}
                                            </span>
                                            <p class="text-xs text-gray-500 mt-1">{{ $call->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Chart Placeholder -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">📈 Tren Kejadian (7 Hari Terakhir)</h3>

                    <div class="space-y-3">
                        @forelse($chartData as $data)
                            <div class="flex items-center gap-3">
                                <div class="w-32 text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($data->date)->format('d M Y') }}</div>
                                <div class="flex-1 bg-gray-200 rounded-full h-6">
                                    <div class="bg-teal-600 h-6 rounded-full flex items-center justify-end pr-2"
                                        style="width: {{ $data->total > 0 ? ($data->total / max($chartData->max('total'), 1) * 100) : 0 }}%">
                                        <span class="text-white text-xs font-bold">{{ $data->total }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-8">Tidak ada data kejadian dalam 7 hari terakhir</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Resource Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-3">🏥 Rumah Sakit Rujukan</h3>
                    <p class="text-4xl font-bold text-blue-600">{{ $stats['total_hospitals'] }}</p>
                    <p class="text-sm text-gray-500 mt-1">Total rumah sakit dalam sistem</p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-3">🏢 Puskesmas/Basecamp</h3>
                    <p class="text-4xl font-bold text-green-600">{{ $stats['total_basecamps'] }}</p>
                    <p class="text-sm text-gray-500 mt-1">Total puskesmas/basecamp aktif</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>