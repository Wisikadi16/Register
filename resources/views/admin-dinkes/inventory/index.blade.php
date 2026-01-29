<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            📦 Manajemen Inventori (Stok, Oksigen, Obat, ATK)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Add Inventory Form -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-bold text-lg mb-4 text-teal-600">Tambah Barang Baru</h3>
                <form action="{{ route('admin.dinkes.inventory.store') }}" method="POST"
                    class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 uppercase tracking-wider text-xs">Nama
                            Barang</label>
                        <input type="text" name="name" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm">
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 uppercase tracking-wider text-xs">Kategori</label>
                        <select name="category" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm">
                            <option value="stock">Stok Barang</option>
                            <option value="oxygen">Tabung Oksigen</option>
                            <option value="medicine">Usulan Obat</option>
                            <option value="atk">ATK</option>
                            <option value="household">Kebutuhan Rumah Tangga</option>
                        </select>
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 uppercase tracking-wider text-xs">Jumlah</label>
                        <input type="number" name="quantity" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm">
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 uppercase tracking-wider text-xs">Satuan</label>
                        <input type="text" name="unit" placeholder="pcs, box, dll"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm">
                    </div>
                    <button type="submit"
                        class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded shadow-lg transition text-sm">
                        Simpan Data
                    </button>
                </form>
            </div>

            <!-- Inventory List -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 uppercase tracking-wider text-xs font-bold text-gray-500">
                            <tr>
                                <th class="px-6 py-4 text-left">Nama Barang</th>
                                <th class="px-6 py-4 text-left">Kategori</th>
                                <th class="px-6 py-4 text-center">Stok</th>
                                <th class="px-6 py-4 text-left">Satuan</th>
                                <th class="px-6 py-4 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-sm">
                            @forelse($inventories as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 font-bold text-gray-900">{{ $item->name }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2 py-1 text-xs rounded-lg bg-gray-100 uppercase font-bold text-gray-600">
                                            {{ str_replace('_', ' ', $item->category) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center font-bold">{{ $item->quantity }}</td>
                                    <td class="px-6 py-4">{{ $item->unit }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-2 py-1 text-xs rounded-full font-bold
                                                @if($item->quantity > 10) bg-green-100 text-green-700
                                                @elseif($item->quantity > 0) bg-amber-100 text-amber-700
                                                @else bg-red-100 text-red-700 @endif">
                                            @if($item->quantity > 10) Tersedia
                                            @elseif($item->quantity > 0) Stok Rendah
                                            @else Habis @endif
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500 italic">Belum ada data
                                        inventori.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>