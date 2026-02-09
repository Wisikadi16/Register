<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            💡 Manajemen Utilitas (Listrik & PAM)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Submit Utility Form -->
            <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-amber-500">
                <h3 class="font-bold text-lg mb-4 text-amber-700">Input Tagihan Utilitas</h3>
                <form action="{{ route('admin.dinkes.utilities.store') }}" method="POST"
                    class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end text-sm">
                    @csrf
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Jenis Utilitas</label>
                        <select name="type" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                            <option value="listrik">Listrik</option>
                            <option value="pam">PAM (Air)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Nominal Tagihan</label>
                        <input type="number" name="amount" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Periode (Bulan-Tahun)</label>
                        <input type="month" name="billing_period" required value="{{ date('Y-m') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                    </div>
                    <button type="submit"
                        class="bg-amber-600 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded shadow-lg transition">
                        Simpan Tagihan
                    </button>
                </form>
            </div>

            <!-- Utility List -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 uppercase tracking-wider text-xs font-bold text-gray-500">
                            <tr>
                                <th class="px-6 py-4 text-left">Periode</th>
                                <th class="px-6 py-4 text-left">Jenis</th>
                                <th class="px-6 py-4 text-right">Nominal</th>
                                <th class="px-6 py-4 text-center">Status</th>
                                <th class="px-6 py-4 text-center">Waktu Input</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-sm">
                            @forelse($utilities as $util)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 font-bold">
                                        {{ \Carbon\Carbon::parse($util->billing_period)->format('F Y') }}
                                    </td>
                                    <td class="px-6 py-4 uppercase">
                                        <span class="font-bold flex items-center gap-2">
                                            @if($util->type == 'listrik') ⚡ @else 💧 @endif
                                            {{ $util->type }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right font-black text-amber-700">Rp
                                        {{ number_format($util->amount, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="px-2 py-1 text-xs rounded-full font-bold bg-amber-100 text-amber-700 uppercase">
                                            {{ $util->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center text-gray-400 text-xs">
                                        {{ $util->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 text-center flex justify-center gap-2">
                                        <a href="{{ route('admin.dinkes.utilities.edit', $util->id) }}"
                                            class="text-blue-600 hover:text-blue-900 font-bold text-xs uppercase bg-blue-100 px-2 py-1 rounded">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.dinkes.utilities.destroy', $util->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 font-bold text-xs uppercase bg-red-100 px-2 py-1 rounded">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500 italic">Belum ada data
                                        utilitas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>