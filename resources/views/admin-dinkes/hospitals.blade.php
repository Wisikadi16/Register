<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            🏥 Monitoring Ketersediaan Bed Rumah Sakit
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center mb-6">
                    <p class="text-gray-600">Data ketersediaan bed diupdate secara real-time oleh masing-masing
                        Fasilitas Kesehatan.</p>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($hospitals as $rs)
                            <div class="border rounded-xl p-6 bg-gray-50 hover:shadow-lg transition duration-300">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $rs->name }}</h3>
                                <div class="text-sm text-gray-500 mb-4 h-12 overflow-hidden">{{ $rs->address }}</div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-blue-600 rounded-lg p-4 text-center text-white">
                                        <p class="text-xs opacity-75 uppercase">Bed IGD</p>
                                        <p class="text-2xl font-black mt-1">{{ $rs->available_bed_igd }}</p>
                                    </div>
                                    <div class="bg-teal-600 rounded-lg p-4 text-center text-white">
                                        <p class="text-xs opacity-75 uppercase">Bed ICU</p>
                                        <p class="text-2xl font-black mt-1">{{ $rs->available_bed_icu }}</p>
                                    </div>
                                </div>

                                <div class="mt-4 flex justify-between items-center text-sm">
                                    <span class="text-gray-600">📞 {{ $rs->phone_igd }}</span>
                                    <span class="text-xs text-gray-400">Update:
                                        {{ $rs->updated_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>