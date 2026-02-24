<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-3xl font-black text-charcoal tracking-tight">
                    WPS <span class="text-rescue-red font-semibold">Operator</span>
                </h2>
                <p class="text-slate-500 font-medium mt-1">Pusat Komando & Dispatche Ambulan</p>
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            {{-- WELCOME MESSAGE (Clean, Glassy Card) --}}
            <div
                class="bg-gradient-to-r from-rescue-red to-gray-600 p-8 md:p-10 shadow-lg relative overflow-hidden flex items-center justify-between group">
                <div class="relative z-10 max-w-2xl">
                    <h3 class="text-2xl font-bold text-white mb-3">Selamat Datang, {{ Auth::user()->name }}</h3>
                    <p class="text-red-50 leading-relaxed">
                        Anda memegang kendali penuh operasional hari ini. Pantau panggilan darurat, koordinasikan
                        armada, dan pastikan setiap pasien mendapatkan penanganan secepatnya.
                    </p>
                </div>
                <div
                    class="hidden md:flex relative z-10 w-24 h-24 bg-white/20 rounded-full items-center justify-center text-white text-4xl group-hover:scale-110 transition duration-500 backdrop-blur-sm shadow-inner">
                    <i class="fas fa-headset"></i>
                </div>
                <!-- Decorative subtle blur -->
                <div
                    class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full blur-3xl opacity-10 -translate-y-1/2 translate-x-1/2 pattern-grid-lg text-white">
                </div>
            </div>

            @php
                $activeCallsCount = $emergencies->where('status', '!=', 'completed')->count();
            @endphp

            {{-- HORIZONTAL STATS RIBBON --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Panggilan Aktif -->
                <div
                    class="bg-white rounded-[2rem] p-6 border {{ $activeCallsCount > 0 ? 'border-rescue-red shadow-lg shadow-rescue-red/10' : 'border-slate-100 shadow-sm' }} transition-all duration-300 relative overflow-hidden">
                    @if($activeCallsCount > 0)
                        <div class="absolute top-0 left-0 w-1 h-full bg-rescue-red"></div>
                    @endif
                    <div class="flex justify-between items-center h-full">
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Panggilan Aktif
                            </p>
                            <h4
                                class="text-5xl font-black {{ $activeCallsCount > 0 ? 'text-rescue-red drop-shadow-sm' : 'text-charcoal' }}">
                                {{ $activeCallsCount }}
                            </h4>
                        </div>
                        <div
                            class="w-16 h-16 {{ $activeCallsCount > 0 ? 'bg-red-50 text-rescue-red' : 'bg-slate-50 text-slate-300' }} rounded-2xl flex items-center justify-center text-2xl relative">
                            @if($activeCallsCount > 0)
                                <span class="absolute top-0 right-0 flex w-4 h-4 -mt-1 -mr-1">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rescue-red opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-4 w-4 bg-rescue-red"></span>
                                </span>
                            @endif
                            <i class="fas fa-phone-volume"></i>
                        </div>
                    </div>
                </div>

                <!-- Status Armada -->
                <div class="bg-white rounded-[2rem] p-6 border border-slate-100 shadow-sm flex flex-col justify-center">
                    <div class="flex justify-between items-center mb-5">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Status Armada</p>
                        <i class="fas fa-ambulance text-slate-300 text-xl"></i>
                    </div>
                    <div class="space-y-3">
                        @foreach($ambulances->take(2) as $amb)
                                            <div class="flex justify-between items-center bg-slate-50 p-2.5 px-3 rounded-xl">
                                                <span class="font-bold text-charcoal text-xs truncate max-w-[120px]">{{ $amb->name }}</span>
                                                <span
                                                    class="px-2.5 py-1 rounded-md text-[10px] font-black uppercase tracking-wider
                                                                                                                                                            {{ $amb->status == 'ready' ? 'bg-teal-50 text-teal-600' :
                            ($amb->status == 'busy' ? 'bg-rescue-red border border-rescue-red/20 text-white shadow-sm shadow-rescue-red/30' : 'bg-slate-200 text-slate-600') }}">
                                                    {{ $amb->status }}
                                                </span>
                                            </div>
                        @endforeach
                        @if($ambulances->count() > 2)
                            <div class="text-xs text-slate-400 font-bold px-2 text-right">
                                + {{ $ambulances->count() - 2 }} armada lain
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Bed RS -->
                <div
                    class="bg-white rounded-[2rem] p-6 border border-slate-100 shadow-sm flex flex-col justify-between">
                    <div class="flex justify-between items-center mb-5">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Ketersediaan Bed</p>
                        <i class="fas fa-procedures text-slate-300 text-xl"></i>
                    </div>
                    <div class="space-y-3 overflow-y-auto custom-scrollbar max-h-[100px] pr-2">
                        @foreach($hospitals->take(3) as $rs)
                            <div
                                class="flex justify-between items-center border-b border-slate-50 pb-2 last:border-0 last:pb-0">
                                <span class="font-bold text-slate-600 text-[11px] truncate w-2/3">{{ $rs->name }}</span>
                                <span class="font-black text-charcoal text-sm flex items-center gap-1">
                                    {{ $rs->available_bed_igd }}
                                    <span class="text-[9px] text-slate-400 font-bold uppercase">Bed</span>
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- MENU NAVIGASI (Elegant Clean Cards) --}}
            <div>
                <h3 class="text-lg font-black text-charcoal mb-5 px-1 flex items-center gap-2">
                    Aksi & Modul
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-5">

                    <!-- Nav Button 1 -->
                    <a href="{{ route('operator.schedules.index') }}"
                        class="group bg-white border border-slate-200 hover:border-rescue-red rounded-[2rem] p-6 flex flex-col gap-4 transition duration-300 hover:shadow-lg hover:shadow-rescue-red/10">
                        <div
                            class="w-14 h-14 bg-red-50 text-rescue-red rounded-2xl flex items-center justify-center text-xl transition shadow-sm">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-charcoal text-sm mb-1">Jadwal Shift</h4>
                            <p class="text-[11px] font-medium text-slate-400">Atur Driver & Nakes</p>
                        </div>
                    </a>

                    <!-- Nav Button 2 -->
                    <a href="{{ route('operator.reports.index') }}"
                        class="group bg-white border border-slate-200 hover:border-rescue-red rounded-[2rem] p-6 flex flex-col gap-4 transition duration-300 hover:shadow-lg hover:shadow-rescue-red/10">
                        <div
                            class="w-14 h-14 bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center text-xl transition shadow-sm">
                            <i class="fas fa-file-medical-alt"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-charcoal text-sm mb-1">Rekap Pasien</h4>
                            <p class="text-[11px] font-medium text-slate-400">Sinkronisasi Histori</p>
                        </div>
                    </a>

                    <!-- Nav Button 3 -->
                    <a href="{{ route('operator.ambulances.private') }}"
                        class="group bg-white border border-slate-200 hover:border-rescue-red rounded-[2rem] p-6 flex flex-col gap-4 transition duration-300 hover:shadow-lg hover:shadow-rescue-red/10">
                        <div
                            class="w-14 h-14 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center text-xl transition shadow-sm">
                            <i class="fas fa-ambulance"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-charcoal text-sm mb-1">Ambulan Luar</h4>
                            <p class="text-[11px] font-medium text-slate-400">Manajemen Swasta</p>
                        </div>
                    </a>

                    <!-- Nav Button 4 -->
                    <a href="{{ route('operator.contacts.index') }}"
                        class="group bg-white border border-slate-200 hover:border-rescue-red rounded-[2rem] p-6 flex flex-col gap-4 transition duration-300 hover:shadow-lg hover:shadow-rescue-red/10">
                        <div
                            class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl transition shadow-sm">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-charcoal text-sm mb-1">Kontak Radio</h4>
                            <p class="text-[11px] font-medium text-slate-400">Hubungi Cepat</p>
                        </div>
                    </a>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>