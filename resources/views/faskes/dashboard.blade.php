<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-3xl font-black text-charcoal tracking-tight">
                    Update <span class="text-blue-600 font-semibold">Kamar Rumah Sakit</span>
                </h2>
                <p class="text-slate-500 font-medium mt-1">Sistem Informasi Ketersediaan Bed (IGD & ICU)</p>
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
                class="bg-gradient-to-r from-rescue-red to-red-600 rounded-[2rem] p-8 md:p-10 shadow-lg flex flex-col md:flex-row items-center justify-between gap-8 relative overflow-hidden group">
                <div
                    class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full blur-3xl opacity-10 -translate-y-1/2 translate-x-1/2 pattern-grid-lg text-white">
                </div>

                <div class="relative z-10 max-w-2xl text-center md:text-left">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white/20 border border-white/20 text-white text-[10px] font-black uppercase tracking-widest mb-4 shadow-sm backdrop-blur-sm">
                        <i class="fas fa-hospital-user text-white"></i> Faskes Dashboard
                    </div>
                    <h1 class="text-3xl md:text-4xl font-black text-white tracking-tight mb-2">
                        Halo, {{ Auth::user()->name }} 👋
                    </h1>
                    <p class="text-red-50 text-base leading-relaxed">
                        Mohon pastikan data ketersediaan tempat tidur (Bed) selalu ter-update secara real-time untuk
                        memperlancar proses rujukan pasien darurat.
                    </p>
                </div>

                <div
                    class="relative z-10 hidden md:flex w-32 h-32 bg-white/20 border border-white/20 rounded-[2rem] shadow-inner items-center justify-center text-white/70 text-6xl group-hover:scale-105 group-hover:-rotate-3 transition duration-700 backdrop-blur-sm">
                    <i class="fas fa-procedures text-white"></i>
                </div>
            </div>

            <div class="flex items-center gap-3 pl-2 mt-8 mb-4">
                <div class="w-8 h-8 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center text-sm">
                    <i class="fas fa-edit"></i>
                </div>
                <h3 class="text-lg font-bold text-charcoal">Update Ketersediaan Bed</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
                @foreach($hospitals as $rs)
                    <div
                        class="bg-white rounded-[2rem] shadow-sm hover:shadow-lg transition-all duration-300 border border-slate-100 overflow-hidden relative group">
                        <form action="{{ route('faskes.update', $rs->id) }}" method="POST" class="flex flex-col h-full">
                            @csrf
                            @method('PUT')

                            <div class="p-6">
                                <div class="flex items-center justify-between mb-3">
                                    <h4
                                        class="text-lg font-black text-charcoal group-hover:text-blue-600 transition-colors">
                                        {{ $rs->name }}
                                    </h4>
                                </div>
                                <div
                                    class="inline-flex items-center gap-2 text-[10px] font-bold text-slate-400 bg-slate-50 px-3 py-1.5 rounded-lg uppercase tracking-wider mb-6">
                                    <i class="far fa-clock"></i> Diperbarui {{ $rs->updated_at->diffForHumans() }}
                                </div>

                                <div class="grid grid-cols-2 gap-4 mt-2">
                                    <div
                                        class="bg-slate-50 border border-slate-100 p-4 rounded-xl flex flex-col items-center justify-center text-center">
                                        <label
                                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Kapasitas
                                            IGD</label>
                                        <input type="number" name="available_bed_igd" value="{{ $rs->available_bed_igd }}"
                                            class="w-full bg-white rounded-lg border-slate-200 focus:border-teal-500 focus:ring-teal-500 text-2xl font-black text-teal-600 text-center shadow-sm py-2">
                                    </div>
                                    <div
                                        class="bg-slate-50 border border-slate-100 p-4 rounded-xl flex flex-col items-center justify-center text-center">
                                        <label
                                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Kapasitas
                                            ICU</label>
                                        <input type="number" name="available_bed_icu" value="{{ $rs->available_bed_icu }}"
                                            class="w-full bg-white rounded-lg border-slate-200 focus:border-rescue-red focus:ring-rescue-red text-2xl font-black text-rescue-red text-center shadow-sm py-2">
                                    </div>
                                </div>
                            </div>

                            <div class="px-6 pb-6 mt-auto">
                                <button type="submit"
                                    class="w-full flex items-center justify-center gap-2 bg-charcoal hover:bg-slate-800 text-white font-bold py-3.5 rounded-xl transition-all shadow-md active:scale-95 text-sm uppercase tracking-wider">
                                    <i class="fas fa-save"></i> Simpan Data
                                </button>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>