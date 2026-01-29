<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            🚑 Monitoring Status Armada (Ambulans)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($ambulances as $ambulance)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden border-t-4 
                            @if($ambulance->status == 'available') border-green-500
                            @elseif($ambulance->status == 'on_duty') border-blue-500
                            @else border-red-500 @endif">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-bold text-gray-800">{{ $ambulance->name }}</h3>
                                <span class="px-2 py-1 text-xs font-bold rounded-full 
                                        @if($ambulance->status == 'available') bg-green-100 text-green-800
                                        @elseif($ambulance->status == 'on_duty') bg-blue-100 text-blue-800
                                        @else bg-red-100 text-red-800 @endif">
                                    {{ strtoupper($ambulance->status) }}
                                </span>
                            </div>

                            <div class="space-y-2 text-sm text-gray-600">
                                <p><span class="font-semibold">Plat Nomor:</span> {{ $ambulance->plat_number }}</p>
                                <p><span class="font-semibold">Puskesmas:</span> {{ $ambulance->basecamp->name ?? '-' }}</p>
                                <p><span class="font-semibold">Driver:</span> {{ $ambulance->driver->name ?? 'Tidak ada' }}
                                </p>
                            </div>

                            @if($ambulance->status == 'on_duty')
                                <div class="mt-4 p-3 bg-blue-50 rounded text-xs text-blue-700">
                                    Sedang menangani kejadian darurat
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>