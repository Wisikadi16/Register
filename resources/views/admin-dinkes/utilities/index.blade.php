<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Page Header -->
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div>
                    <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Tagihan & Utilitas</h2>
                    <p class="text-slate-500 mt-1">Pencatatan pembayaran listrik, air, dan utilitas lainnya.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Submit Utility Form -->
                <div class="bg-white p-8 rounded-[2rem] shadow-lg shadow-amber-900/5 border border-slate-100 h-fit">
                    <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-3">
                        <span class="w-10 h-10 bg-amber-100 flex items-center justify-center rounded-xl text-amber-600">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </span>
                        Input Tagihan
                    </h3>

                    <form action="{{ route('admin.dinkes.utilities.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Jenis Utilitas</label>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="cursor-pointer">
                                    <input type="radio" name="type" value="listrik" class="peer sr-only" required>
                                    <div
                                        class="rounded-xl border-2 border-slate-200 peer-checked:border-amber-500 peer-checked:bg-amber-50 p-3 text-center transition hover:bg-slate-50">
                                        <i
                                            class="fas fa-bolt text-xl mb-1 text-slate-400 peer-checked:text-amber-600"></i>
                                        <div class="text-xs font-bold text-slate-600 peer-checked:text-amber-700">
                                            Listrik</div>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="type" value="pam" class="peer sr-only">
                                    <div
                                        class="rounded-xl border-2 border-slate-200 peer-checked:border-blue-500 peer-checked:bg-blue-50 p-3 text-center transition hover:bg-slate-50">
                                        <i
                                            class="fas fa-tint text-xl mb-1 text-slate-400 peer-checked:text-blue-600"></i>
                                        <div class="text-xs font-bold text-slate-600 peer-checked:text-blue-700">PAM
                                            (Air)</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Nominal Tagihan (Rp)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-3.5 text-slate-400 font-bold text-sm">Rp</span>
                                <input type="number" name="amount" required placeholder="0"
                                    class="w-full rounded-xl border-slate-200 focus:border-amber-500 focus:ring-amber-500 transition pl-10 pr-4 py-3 bg-slate-50 focus:bg-white text-sm font-semibold">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Periode (Bulan-Tahun)</label>
                            <input type="month" name="billing_period" required value="{{ date('Y-m') }}"
                                class="w-full rounded-xl border-slate-200 focus:border-amber-500 focus:ring-amber-500 transition px-4 py-3 bg-slate-50 focus:bg-white text-sm">
                        </div>

                        <button type="submit"
                            class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-amber-500/30 transition transform hover:-translate-y-1 flex items-center justify-center gap-2">
                            <i class="fas fa-save"></i> Simpan Tagihan
                        </button>
                    </form>
                </div>

                <!-- Utility List -->
                <div
                    class="lg:col-span-2 bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden flex flex-col h-full">
                    <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                        <h3 class="font-bold text-lg text-slate-800 flex items-center gap-2">
                            <i class="fas fa-list text-slate-400"></i> Riwayat Pembayaran
                        </h3>
                    </div>

                    <div class="overflow-x-auto p-2">
                        <table class="min-w-full divide-y divide-slate-50">
                            <thead class="bg-white">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">
                                        Periode</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">
                                        Jenis</th>
                                    <th
                                        class="px-6 py-4 text-right text-xs font-black text-slate-400 uppercase tracking-wider">
                                        Nominal</th>
                                    <th
                                        class="px-6 py-4 text-center text-xs font-black text-slate-400 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-4 text-center text-xs font-black text-slate-400 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-50 text-sm">
                                @forelse($utilities as $util)
                                    <tr class="hover:bg-slate-50 transition duration-150 group">
                                        <td class="px-6 py-4 whitespace-nowrap font-bold text-slate-700">
                                            {{ \Carbon\Carbon::parse($util->billing_period)->format('F Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap uppercase">
                                            @if($util->type == 'listrik')
                                                <span
                                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-amber-50 text-amber-700 font-bold text-xs border border-amber-100">
                                                    <i class="fas fa-bolt"></i> Listrik
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-blue-50 text-blue-700 font-bold text-xs border border-blue-100">
                                                    <i class="fas fa-tint"></i> PAM
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right font-black text-slate-700">
                                            Rp {{ number_format($util->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span
                                                class="px-3 py-1 text-[10px] rounded-full font-bold bg-green-100 text-green-700 uppercase border border-green-200">
                                                {{ $util->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div
                                                class="flex justify-center gap-2 opacity-50 group-hover:opacity-100 transition">
                                                <a href="{{ route('admin.dinkes.utilities.edit', $util->id) }}"
                                                    class="text-blue-500 hover:text-white p-2 hover:bg-blue-500 rounded-lg transition shadow-sm"
                                                    title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <form action="{{ route('admin.dinkes.utilities.destroy', $util->id) }}"
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
                                        <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                            <div
                                                class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3">
                                                <i class="fas fa-file-invoice text-2xl opacity-30"></i>
                                            </div>
                                            <p class="font-medium text-sm">Belum ada data utilitas.</p>
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