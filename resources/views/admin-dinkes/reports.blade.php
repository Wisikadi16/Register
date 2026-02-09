<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Page Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Laporan Operasional</h2>
                    <p class="text-slate-500 mt-1">Rekapitulasi kejadian darurat dan penanganan.</p>
                </div>
            </div>

            <!-- Filter Section Card -->
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
                <form action="{{ route('admin.dinkes.reports') }}" method="GET"
                    class="flex flex-col md:flex-row gap-4 items-end">
                    <div class="w-full md:w-auto">
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Dari Tanggal</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-calendar text-slate-400"></i>
                            </div>
                            <input type="date" name="start_date" value="{{ request('start_date') }}"
                                class="pl-10 block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </div>
                    </div>
                    <div class="w-full md:w-auto">
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Sampai Tanggal</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-calendar text-slate-400"></i>
                            </div>
                            <input type="date" name="end_date" value="{{ request('end_date') }}"
                                class="pl-10 block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </div>
                    </div>
                    <div class="flex gap-2 w-full md:w-auto">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-2.5 bg-blue-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 gap-2 shadow-lg shadow-blue-500/30">
                            <i class="fas fa-filter"></i> Terapkan
                        </button>
                        @if(request()->has('start_date'))
                            <a href="{{ route('admin.dinkes.reports') }}"
                                class="inline-flex items-center px-4 py-2.5 bg-slate-100 border border-transparent rounded-xl font-bold text-xs text-slate-600 uppercase tracking-widest hover:bg-slate-200 transition ease-in-out duration-150">
                                <i class="fas fa-undo mr-1"></i> Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Reports Table Card -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                    <h3 class="font-bold text-lg text-slate-800 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                            <i class="fas fa-list-alt"></i>
                        </span>
                        Daftar Kejadian
                    </h3>
                    <button
                        class="text-sm font-bold text-slate-500 hover:text-blue-600 flex items-center gap-1 transition">
                        <i class="fas fa-download"></i> Export Data
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-50">
                        <thead class="bg-white">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">
                                    Waktu</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">
                                    Pelapor</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">
                                    Lokasi</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">
                                    Ambulan</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">
                                    Tujuan RS</th>
                                <th
                                    class="px-6 py-4 text-center text-xs font-black text-slate-400 uppercase tracking-wider">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-50">
                            @forelse($calls as $call)
                                <tr class="hover:bg-slate-50 transition duration-150 group">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-700">
                                        <div class="flex items-center gap-2">
                                            <i class="far fa-clock text-slate-400"></i>
                                            {{ $call->created_at->format('d/m/Y H:i') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700 font-semibold">
                                        {{ $call->user->name }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-500">
                                        <div class="flex items-start gap-2">
                                            <i class="fas fa-map-marker-alt text-red-400 mt-1 shrink-0"></i>
                                            <span
                                                class="truncate max-w-xs block">{{ Str::limit($call->location, 40) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($call->ambulance)
                                            <span
                                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-bold text-xs">
                                                <i class="fas fa-ambulance"></i> {{ $call->ambulance->name }}
                                            </span>
                                        @else
                                            <span class="text-slate-400 text-xs italic">Belum ditugaskan</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($call->hospital)
                                            <div class="flex items-center gap-1.5">
                                                <i class="fas fa-hospital text-blue-400"></i>
                                                <span class="text-slate-700 font-medium">{{ $call->hospital->name }}</span>
                                            </div>
                                        @else
                                            <span class="text-slate-400 text-xs">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full border 
                                                    @if($call->status == 'completed') bg-green-50 text-green-700 border-green-100
                                                    @elseif($call->status == 'process' || $call->status == 'on_going') bg-blue-50 text-blue-700 border-blue-100
                                                    @elseif($call->status == 'pending') bg-amber-50 text-amber-700 border-amber-100
                                                    @else bg-red-50 text-red-700 border-red-100 @endif">
                                            {{ ucfirst($call->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                                        <div
                                            class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3">
                                            <i class="fas fa-clipboard text-2xl opacity-30"></i>
                                        </div>
                                        <p class="font-medium">Tidak ada data kejadian ditemukan untuk periode ini.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($calls->hasPages())
                    <div class="p-4 border-t border-slate-50 bg-slate-50/50">
                        {{ $calls->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>