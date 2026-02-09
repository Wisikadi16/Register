<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Page Header -->
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div>
                    <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Logistik & Pemeliharaan</h2>
                    <p class="text-slate-500 mt-1">Pengajuan service kendaraan dan bahan bakar armada.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Submit Logistics Form (Card Style) -->
                <div class="bg-white p-8 rounded-[2rem] shadow-lg shadow-blue-900/5 border border-slate-100 h-fit">
                    <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-3">
                        <span class="w-10 h-10 bg-blue-100 flex items-center justify-center rounded-xl text-blue-600">
                            <i class="fas fa-tools"></i>
                        </span>
                        Pengajuan Baru
                    </h3>

                    <form action="{{ route('admin.dinkes.logistics.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Pilih Ambulans</label>
                            <div class="relative">
                                <select name="ambulance_id" required
                                    class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition px-4 py-3 bg-slate-50 focus:bg-white text-sm appearance-none">
                                    @foreach($ambulances as $amb)
                                        <option value="{{ $amb->id }}">{{ $amb->name }} ({{ $amb->plat_number }})</option>
                                    @endforeach
                                </select>
                                <div
                                    class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-500">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Jenis Pengajuan</label>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="cursor-pointer">
                                    <input type="radio" name="type" value="service" class="peer sr-only" required>
                                    <div
                                        class="rounded-xl border-2 border-slate-200 peer-checked:border-blue-500 peer-checked:bg-blue-50 p-3 text-center transition hover:bg-slate-50">
                                        <i
                                            class="fas fa-wrench text-xl mb-1 text-slate-400 peer-checked:text-blue-600"></i>
                                        <div class="text-xs font-bold text-slate-600 peer-checked:text-blue-700">Service
                                        </div>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="type" value="fuel" class="peer sr-only">
                                    <div
                                        class="rounded-xl border-2 border-slate-200 peer-checked:border-blue-500 peer-checked:bg-blue-50 p-3 text-center transition hover:bg-slate-50">
                                        <i
                                            class="fas fa-gas-pump text-xl mb-1 text-slate-400 peer-checked:text-blue-600"></i>
                                        <div class="text-xs font-bold text-slate-600 peer-checked:text-blue-700">BBM
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Biaya (Rp)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-3.5 text-slate-400 font-bold text-sm">Rp</span>
                                <input type="number" name="amount" required placeholder="0"
                                    class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition pl-10 pr-4 py-3 bg-slate-50 focus:bg-white text-sm font-semibold">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal</label>
                            <input type="date" name="request_date" required value="{{ date('Y-m-d') }}"
                                class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition px-4 py-3 bg-slate-50 focus:bg-white text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Keterangan</label>
                            <textarea name="description" rows="3" placeholder="Contoh: Ganti oli dan filter..."
                                class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition px-4 py-3 bg-slate-50 focus:bg-white text-sm"></textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-blue-500/30 transition transform hover:-translate-y-1 flex items-center justify-center gap-2">
                            <i class="fas fa-paper-plane"></i> Ajukan Permintaan
                        </button>
                    </form>
                </div>

                <!-- Logistics List Table -->
                <div
                    class="lg:col-span-2 bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden flex flex-col h-full">
                    <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                        <h3 class="font-bold text-lg text-slate-800 flex items-center gap-2">
                            <i class="fas fa-history text-slate-400"></i> Riwayat Pengajuan
                        </h3>
                    </div>

                    <div class="overflow-x-auto p-2">
                        <table class="min-w-full divide-y divide-slate-50">
                            <thead class="bg-white">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">
                                        Tanggal</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">
                                        Ambulan</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">
                                        Jenis</th>
                                    <th
                                        class="px-6 py-4 text-right text-xs font-black text-slate-400 uppercase tracking-wider">
                                        Biaya</th>
                                    <th
                                        class="px-6 py-4 text-center text-xs font-black text-slate-400 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-4 text-center text-xs font-black text-slate-400 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-50 text-sm">
                                @forelse($logistics as $log)
                                    <tr class="hover:bg-slate-50 transition duration-150 group">
                                        <td class="px-6 py-4 whitespace-nowrap font-bold text-slate-600">
                                            {{ \Carbon\Carbon::parse($log->request_date)->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500">
                                                    <i class="fas fa-ambulance text-xs"></i>
                                                </div>
                                                <div>
                                                    <div class="font-bold text-slate-800">{{ $log->ambulance->name }}</div>
                                                    <div class="text-[10px] text-slate-400">
                                                        {{ $log->ambulance->plat_number }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($log->type == 'service')
                                                <span
                                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-orange-50 text-orange-700 font-bold text-xs border border-orange-100">
                                                    <i class="fas fa-wrench"></i> Service
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-blue-50 text-blue-700 font-bold text-xs border border-blue-100">
                                                    <i class="fas fa-gas-pump"></i> BBM
                                                </span>
                                            @endif
                                            @if($log->description)
                                                <div class="text-xs text-slate-400 mt-1 italic max-w-[150px] truncate">
                                                    {{ $log->description }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right font-black text-slate-700">
                                            Rp {{ number_format($log->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span
                                                class="px-3 py-1 text-[10px] rounded-full font-bold bg-blue-100 text-blue-700 uppercase border border-blue-200">
                                                {{ $log->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div
                                                class="flex justify-center gap-2 opacity-50 group-hover:opacity-100 transition">
                                                <a href="{{ route('admin.dinkes.logistics.edit', $log->id) }}"
                                                    class="text-blue-500 hover:text-white p-2 hover:bg-blue-500 rounded-lg transition shadow-sm"
                                                    title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <form action="{{ route('admin.dinkes.logistics.destroy', $log->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-500 hover:text-white p-2 hover:bg-red-500 rounded-lg transition shadow-sm"
                                                        title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                                            <div
                                                class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3">
                                                <i class="fas fa-folder-open text-2xl opacity-30"></i>
                                            </div>
                                            <p class="font-medium text-sm">Belum ada riwayat logistik.</p>
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