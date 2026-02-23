<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <a href="{{ route('lapangan.dashboard') }}" class="inline-flex items-center text-slate-500 hover:text-blue-600 font-bold mb-6 transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
            </a>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Form Input -->
                <div class="md:col-span-1">
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                        <h3 class="text-xl font-black text-gray-800 mb-6">📅 Ajukan Jadwal Saya</h3>
                        <form action="{{ route('lapangan.schedules.store') }}" method="POST" class="space-y-4">
                            @csrf
                            
                            <!-- User ID Hidden (Auto Auth) -->
                            
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal</label>
                                <input type="date" name="date" class="w-full rounded-xl border-gray-200 bg-gray-50 focus:ring-blue-500" required>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Shift</label>
                                <select name="shift" class="w-full rounded-xl border-gray-200 bg-gray-50 focus:ring-blue-500" required>
                                    <option value="pagi">Pagi (07:00 - 14:00)</option>
                                    <option value="siang">Siang (14:00 - 21:00)</option>
                                    <option value="malam">Malam (21:00 - 07:00)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Catatan (Opsional)</label>
                                <textarea name="notes" rows="2" class="w-full rounded-xl border-gray-200 bg-gray-50 focus:ring-blue-500" placeholder="Contoh: Tukar jaga dengan Budi"></textarea>
                            </div>

                            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-500/30">
                                Ajukan Jadwal
                            </button>
                        </form>
                    </div>
                </div>

                <!-- List Jadwal -->
                <div class="md:col-span-2">
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                        <h3 class="text-xl font-black text-gray-800 mb-6">Jadwal Saya Minggu Ini</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-slate-50 text-slate-500 uppercase text-xs font-bold">
                                    <tr>
                                        <th class="px-4 py-3 rounded-l-xl">Tanggal</th>
                                        <th class="px-4 py-3">Shift</th>
                                        <th class="px-4 py-3 rounded-r-xl">Catatan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @forelse($schedules as $schedule)
                                        <tr class="hover:bg-slate-50 transition">
                                            <td class="px-4 py-4 font-mono text-sm">{{ \Carbon\Carbon::parse($schedule->date)->format('d M Y') }}</td>
                                            <td class="px-4 py-4">
                                                @php
                                                    $color = match($schedule->shift) {
                                                        'pagi' => 'bg-yellow-100 text-yellow-700',
                                                        'siang' => 'bg-orange-100 text-orange-700',
                                                        'malam' => 'bg-indigo-100 text-indigo-700',
                                                    };
                                                @endphp
                                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $color }}">
                                                    {{ $schedule->shift }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-500">{{ $schedule->notes ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-8 text-gray-400">Belum ada jadwal.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
