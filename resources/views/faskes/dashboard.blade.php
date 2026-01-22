<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Fasilitas Kesehatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Update Ketersediaan Kamar (Real-Time)</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($hospitals as $rs)
                    <div class="border rounded-lg p-4 shadow-sm hover:shadow-md transition bg-gray-50">
                        <form action="{{ route('faskes.update', $rs->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-xl font-bold text-blue-800">{{ $rs->name }}</h4>
                                <span class="text-xs bg-gray-200 px-2 py-1 rounded">Update Terakhir: {{ $rs->updated_at->diffForHumans() }}</span>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Bed IGD</label>
                                    <input type="number" name="available_bed_igd" value="{{ $rs->available_bed_igd }}" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg font-bold text-green-600">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Bed ICU</label>
                                    <input type="number" name="available_bed_icu" value="{{ $rs->available_bed_icu }}" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg font-bold text-red-600">
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                                💾 Simpan Perubahan
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>