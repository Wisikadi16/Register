<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Page Header -->
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div>
                    <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Armada Ambulans</h2>
                    <p class="text-slate-500 mt-1">Status ketersediaan dan lokasi unit ambulans.</p>
                </div>
            </div>

            <!-- Ambulance Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($ambulances as $ambulance)
                    <div
                        class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-lg transition duration-300 group flex flex-col h-full relative">

                        <!-- Status Indicator Strip -->
                        <div class="absolute top-0 left-0 w-full h-2 
                                 @if($ambulance->status == 'available') bg-green-500
                                 @elseif($ambulance->status == 'on_duty') bg-blue-500
                                 @else bg-red-500 @endif">
                        </div>

                        <div class="p-8 flex-1 flex flex-col">
                            <div class="flex justify-between items-start mb-6">
                                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl shadow-inner
                                         @if($ambulance->status == 'available') bg-green-50 text-green-600
                                         @elseif($ambulance->status == 'on_duty') bg-blue-50 text-blue-600
                                         @else bg-red-50 text-red-600 @endif">
                                    <i class="fas fa-ambulance"></i>
                                </div>
                                <span class="px-3 py-1 text-xs font-bold rounded-full border 
                                         @if($ambulance->status == 'available') bg-green-50 text-green-700 border-green-100
                                         @elseif($ambulance->status == 'on_duty') bg-blue-50 text-blue-700 border-blue-100
                                         @else bg-red-50 text-red-700 border-red-100 @endif">
                                    {{ strtoupper($ambulance->status) }}
                                </span>
                            </div>

                            <h3 class="text-xl font-bold text-slate-800 mb-1">{{ $ambulance->name }}</h3>
                            <p class="text-sm font-semibold text-slate-500 mb-4 bg-slate-50 px-3 py-1 rounded-lg w-fit">
                                <i class="fas fa-barcode mr-1"></i> {{ $ambulance->plat_number }}
                            </p>

                            <div class="space-y-3 mt-auto">
                                <div class="flex items-center gap-3 text-sm text-slate-600">
                                    <div
                                        class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-400 font-bold uppercase">Basecamp</p>
                                        <p class="font-medium">{{ $ambulance->basecamp->name ?? '-' }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3 text-sm text-slate-600">
                                    <div
                                        class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400">
                                        <i class="fas fa-user-nurse"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-400 font-bold uppercase">Driver</p>
                                        <p class="font-medium">{{ $ambulance->driver->name ?? 'Belum ada driver' }}</p>
                                    </div>
                                </div>
                            </div>

                            @if($ambulance->status == 'on_duty')
                                <div
                                    class="mt-6 p-4 bg-blue-50 rounded-xl border border-blue-100 flex items-start gap-3 animate-pulse">
                                    <i class="fas fa-exclamation-circle text-blue-600 mt-1"></i>
                                    <div>
                                        <p class="text-xs font-bold text-blue-800 uppercase">Status Aktif</p>
                                        <p class="text-sm text-blue-700 leading-snug">Sedang menangani kejadian darurat.</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>