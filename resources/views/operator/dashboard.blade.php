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
                class="bg-gradient-to-r from-rescue-red to-red-600 p-8 md:p-10 shadow-lg relative overflow-hidden flex items-center justify-between group">
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
                    <div class="space-y-3 overflow-y-auto custom-scrollbar max-h-[250px] pr-2">
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
                <div class="grid grid-cols-2 md:grid-cols-5 gap-5">

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

                    <!-- Nav Button 5 (Tiket Faskes) -->
                    <a href="{{ route('operator.requests.index') }}"
                        class="group bg-white border border-slate-200 hover:border-purple-500 rounded-[2rem] p-6 flex flex-col gap-4 transition duration-300 hover:shadow-lg hover:shadow-purple-500/10">
                        <div
                            class="w-14 h-14 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center text-xl transition shadow-sm group-hover:scale-110">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-charcoal text-sm mb-1">Tiket Faskes</h4>
                            <p class="text-[11px] font-medium text-slate-400">Bantuan & Logistik</p>
                        </div>
                    </a>

                </div>
            </div>

            {{-- DAFTAR PANGGILAN DARURAT (MISSING LIST RESTORED) --}}
            <div>
                <div class="flex justify-between items-center mb-5 px-1">
                    <h3 class="text-lg font-black text-charcoal flex items-center gap-2">
                        Panggilan Masuk & Aktif
                    </h3>
                </div>

                <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm whitespace-nowrap">
                            <thead class="bg-slate-50 text-slate-500 font-bold uppercase tracking-wider text-[10px]">
                                <tr>
                                    <th class="px-6 py-4 rounded-tl-3xl">Waktu & Pelapor</th>
                                    <th class="px-6 py-4">Lokasi Kejadian</th>
                                    <th class="px-6 py-4">Status & Armada</th>
                                    <th class="px-6 py-4 rounded-tr-3xl text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($emergencies as $call)
                                    <tr class="hover:bg-slate-50 transition duration-200">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-{{ $call->status == 'pending' ? 'red' : ($call->status == 'process' ? 'amber' : 'teal') }}-50 text-{{ $call->status == 'pending' ? 'rescue-red' : ($call->status == 'process' ? 'amber-600' : 'teal-600') }} flex items-center justify-center font-bold {{ $call->type == 'phone_call' && $call->status == 'pending' ? 'animate-pulse' : '' }}">

                                                    @if($call->type == 'phone_call')
                                                        <i class="fas fa-phone-volume"></i>
                                                    @else
                                                        <i
                                                            class="fas fa-{{ $call->status == 'pending' ? 'bell' : ($call->status == 'process' ? 'spinner fa-spin' : 'check') }}"></i>
                                                    @endif
                                                </div>
                                                <div>
                                                    <p class="font-bold text-charcoal text-sm">
                                                        {{ $call->user->name ?? 'Anonim' }}
                                                    </p>
                                                    <p class="text-xs text-slate-400 font-medium">
                                                        {{ $call->created_at->format('H:i') }} WIB
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="font-bold text-charcoal text-sm truncate max-w-[200px]"
                                                title="{{ $call->location }}">{{ $call->location }}</p>
                                            <p class="text-xs text-slate-400 truncate max-w-[200px]"
                                                title="{{ $call->description }}">{{ $call->description }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($call->type == 'phone_call')
                                                <span
                                                    class="bg-blue-50 text-blue-600 px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-blue-100 mr-1">Tlp
                                                    112</span>
                                            @endif

                                            @if($call->status == 'pending')
                                                <span
                                                    class="bg-red-50 text-rescue-red px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-red-100">Menunggu</span>
                                            @elseif($call->status == 'process')
                                                <span
                                                    class="bg-amber-50 text-amber-600 px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-amber-100">Diproses</span>
                                            @else
                                                <span
                                                    class="bg-teal-50 text-teal-600 px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-teal-100">Selesai</span>
                                            @endif

                                            @if($call->ambulance)
                                                <p class="text-xs font-bold text-slate-600 mt-1"><i
                                                        class="fas fa-ambulance mr-1"></i> {{ $call->ambulance->name }}</p>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            @if($call->status != 'completed' && $call->status != 'cancelled')
                                                <button
                                                    onclick="document.getElementById('actionModal-{{ $call->id }}').classList.remove('hidden')"
                                                    class="bg-white border border-slate-200 hover:border-slate-300 text-slate-600 font-bold py-2 px-4 rounded-xl text-xs transition shadow-sm">
                                                    Kelola <i class="fas fa-chevron-right ml-1 text-[10px]"></i>
                                                </button>
                                            @else
                                                <span class="text-xs font-bold text-slate-400">Tidak ada aksi</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <!-- Action Modal -->
                                    <div id="actionModal-{{ $call->id }}"
                                        class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4">
                                        <div class="bg-white rounded-2xl max-w-md w-full p-6 text-left whitespace-normal">
                                            <div class="flex justify-between items-center mb-4">
                                                <h3 class="text-xl font-bold text-gray-800">Kelola Panggilan
                                                    #{{ $call->id }}</h3>
                                                <button
                                                    onclick="document.getElementById('actionModal-{{ $call->id }}').classList.add('hidden')"
                                                    class="text-gray-400 hover:text-gray-600">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>

                                            <div class="mb-6 bg-slate-50 p-4 rounded-xl text-sm">
                                                <p><strong>Pelapor:</strong> {{ $call->user->name ?? 'Anonim' }}</p>
                                                <p><strong>Lokasi:</strong> {{ $call->location }}</p>
                                                <p><strong>Keterangan:</strong> {{ $call->description }}</p>
                                            </div>

                                            <div class="space-y-3">
                                                <div class="border-t border-slate-100 pt-3">
                                                    <h4 class="font-bold text-sm mb-2 text-charcoal">Tugaskan Ambulan</h4>
                                                    <form action="{{ route('operator.emergency.assign', $call->id) }}"
                                                        method="POST" class="flex gap-2">
                                                        @csrf
                                                        <select name="ambulance_id"
                                                            class="flex-1 rounded-xl border-gray-200 text-sm focus:ring-blue-500 focus:border-blue-500"
                                                            required>
                                                            <option value="" disabled selected>-- Pilih Ambulan --</option>
                                                            @foreach($ambulances->where('status', 'ready') as $amb)
                                                                <option value="{{ $amb->id }}">{{ $amb->name }}
                                                                    ({{ $amb->plat_number }})</option>
                                                            @endforeach
                                                        </select>
                                                        <button type="submit"
                                                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 rounded-xl font-bold text-sm transition shadow-sm">
                                                            Tugaskan
                                                        </button>
                                                    </form>
                                                </div>

                                                <div class="border-t border-slate-100 pt-3">
                                                    <h4 class="font-bold text-sm mb-2 text-charcoal">Atur Tujuan Rujukan
                                                        (RS)</h4>
                                                    <form
                                                        action="{{ route('operator.emergency.set-destination', $call->id) }}"
                                                        method="POST" class="flex gap-2">
                                                        @csrf
                                                        <select name="hospital_id"
                                                            class="flex-1 rounded-xl border-gray-200 text-sm focus:ring-teal-500 focus:border-teal-500"
                                                            required>
                                                            <option value="" disabled selected>-- Pilih Rumah Sakit --
                                                            </option>
                                                            @foreach($hospitals as $rs)
                                                                <option value="{{ $rs->id }}">{{ $rs->name }} (IGD:
                                                                    {{ $rs->available_bed_igd }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <button type="submit"
                                                            class="bg-teal-600 hover:bg-teal-700 text-white px-4 rounded-xl font-bold text-sm transition shadow-sm">
                                                            Simpan
                                                        </button>
                                                    </form>
                                                </div>

                                                <div class="border-t border-slate-100 pt-3">
                                                    <h4 class="font-bold text-sm mb-2 text-rescue-red">Batalkan Panggilan
                                                    </h4>
                                                    <form action="{{ route('operator.emergency.cancel', $call->id) }}"
                                                        method="POST" class="flex gap-2">
                                                        @csrf
                                                        <input type="text" name="cancellation_note"
                                                            placeholder="Alasan pembatalan..." required
                                                            class="flex-1 rounded-xl border-gray-200 text-sm focus:ring-rescue-red focus:border-rescue-red">
                                                        <button type="submit"
                                                            onclick="return confirm('Yakin batalkan panggilan ini?');"
                                                            class="bg-rescue-red hover:bg-red-700 text-white px-4 rounded-xl font-bold text-sm transition shadow-sm">
                                                            Batalkan
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-slate-400">
                                            <div class="flex flex-col items-center justify-center">
                                                <i class="fas fa-check-circle text-4xl mb-3 text-slate-200"></i>
                                                <p class="font-bold text-slate-500">Bagus! Tidak ada panggilan darurat
                                                    masuk.</p>
                                                <p class="text-xs mt-1">Sistem akan menampilkan pembaruan secara otomatis
                                                    jika ada.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>