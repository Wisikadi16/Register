<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cari Faskes Terdekat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Search Bar --}}
            <div class="mb-8">
                <form action="{{ route('public.faskes') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama rumah sakit atau lokasi..."
                        class="w-full pl-12 pr-4 py-4 rounded-xl border-gray-200 focus:border-teal-500 focus:ring-teal-500 shadow-sm transition">
                    <div class="absolute left-4 top-4 text-gray-400">
                        <i class="fas fa-search text-xl"></i>
                    </div>
                    <button type="submit"
                        class="absolute right-2 top-2 bg-teal-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-teal-700 transition">
                        Cari
                    </button>
                </form>
            </div>

            {{-- Faskes List --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($hospitals as $hospital)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-md transition group">
                        <div class="h-32 bg-gray-100 flex items-center justify-center relative">
                            <i class="fas fa-hospital text-4xl text-gray-300"></i>
                            <div
                                class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-teal-600 shadow-sm">
                                IGD 24 JAM
                            </div>
                        </div>
                        <div class="p-6">
                            <h3
                                class="font-bold text-lg text-gray-800 dark:text-white mb-2 group-hover:text-teal-600 transition">
                                {{ $hospital->name }}
                            </h3>
                            <p class="text-sm text-gray-500 mb-4 flex items-start gap-2">
                                <i class="fas fa-map-marker-alt mt-1 shrink-0"></i>
                                {{ $hospital->address ?? 'Alamat belum tersedia' }}
                            </p>

                            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                                <div class="text-xs font-semibold text-gray-500">
                                    Igd Bed: <span
                                        class="text-teal-600 text-lg">{{ $hospital->available_bed_igd ?? 0 }}</span>
                                </div>
                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($hospital->name . ' ' . $hospital->address) }}"
                                    target="_blank"
                                    class="bg-teal-50 text-teal-700 px-4 py-2 rounded-lg text-sm font-bold hover:bg-teal-100 transition flex items-center gap-2">
                                    <i class="fas fa-location-arrow"></i> Rute
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div
                            class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400 text-2xl">
                            <i class="fas fa-hospital-alt"></i>
                        </div>
                        <h3 class="font-bold text-gray-800">Tidak ada faskes ditemukan</h3>
                        <p class="text-gray-500 text-sm">Coba kata kunci lain atau hubungi operator.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>