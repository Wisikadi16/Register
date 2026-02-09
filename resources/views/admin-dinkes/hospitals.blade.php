<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Page Header -->
            <div class="flex flex-col md:flex-row justify-between items-center text-center md:text-left">
                <div>
                    <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Ketersediaan Bed</h2>
                    <p class="text-slate-500 mt-1">Monitoring real-time kapasitas IGD dan ICU Rumah Sakit.</p>
                </div>
                <div
                    class="mt-4 md:mt-0 flex items-center gap-2 text-sm text-slate-500 bg-white px-4 py-2 rounded-full shadow-sm border border-slate-100">
                    <span class="relative flex h-3 w-3">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                    </span>
                    Live Update
                </div>
            </div>

            <!-- Hospitals Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($hospitals as $rs)
                    <div
                        class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-brand transition duration-300 group flex flex-col h-full">
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-start gap-4 mb-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-teal-50 flex items-center justify-center text-teal-600 text-xl shrink-0 group-hover:scale-110 transition">
                                    <i class="fas fa-hospital-alt"></i>
                                </div>
                                <div>
                                    <h3
                                        class="text-lg font-bold text-slate-800 leading-tight group-hover:text-teal-600 transition">
                                        {{ $rs->name }}</h3>
                                    <p class="text-xs text-slate-400 mt-1 flex items-center gap-1">
                                        <i class="fas fa-map-marker-alt"></i> {{ Str::limit($rs->address, 30) }}
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-3 mt-auto mb-6">
                                <div
                                    class="bg-blue-50 rounded-2xl p-4 text-center border border-blue-100 group-hover:bg-blue-600 group-hover:border-blue-600 group-hover:text-white transition duration-300">
                                    <p class="text-[10px] font-bold uppercase tracking-wider opacity-70 mb-1">Bed IGD</p>
                                    <p class="text-2xl font-black">{{ $rs->available_bed_igd }}</p>
                                </div>
                                <div
                                    class="bg-teal-50 rounded-2xl p-4 text-center border border-teal-100 group-hover:bg-teal-600 group-hover:border-teal-600 group-hover:text-white transition duration-300">
                                    <p class="text-[10px] font-bold uppercase tracking-wider opacity-70 mb-1">Bed ICU</p>
                                    <p class="text-2xl font-black">{{ $rs->available_bed_icu }}</p>
                                </div>
                            </div>

                            <div class="flex justify-between items-center text-sm pt-4 border-t border-slate-50">
                                <a href="tel:{{ $rs->phone_igd }}"
                                    class="flex items-center gap-2 text-slate-600 font-bold hover:text-blue-600 transition bg-slate-50 px-3 py-1.5 rounded-lg hover:bg-blue-50">
                                    <i class="fas fa-phone-alt"></i> {{ $rs->phone_igd }}
                                </a>
                                <div class="text-xs text-slate-400 flex items-center gap-1">
                                    <i class="far fa-clock"></i> {{ $rs->updated_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>