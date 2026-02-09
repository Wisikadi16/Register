<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            ✏️ Edit Data Inventori
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <form action="{{ route('admin.dinkes.inventory.update', $inventory->id) }}" method="POST"
                    class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700 uppercase tracking-wider text-xs">Nama
                            Barang</label>
                        <input type="text" name="name" value="{{ old('name', $inventory->name) }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm">
                    </div>

                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 uppercase tracking-wider text-xs">Kategori</label>
                        <select name="category" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm">
                            <option value="stock" {{ $inventory->category == 'stock' ? 'selected' : '' }}>Stok Barang
                            </option>
                            <option value="oxygen" {{ $inventory->category == 'oxygen' ? 'selected' : '' }}>Tabung Oksigen
                            </option>
                            <option value="medicine" {{ $inventory->category == 'medicine' ? 'selected' : '' }}>Usulan
                                Obat</option>
                            <option value="atk" {{ $inventory->category == 'atk' ? 'selected' : '' }}>ATK</option>
                            <option value="household" {{ $inventory->category == 'household' ? 'selected' : '' }}>
                                Kebutuhan Rumah Tangga</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 uppercase tracking-wider text-xs">Jumlah</label>
                            <input type="number" name="quantity" value="{{ old('quantity', $inventory->quantity) }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm">
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 uppercase tracking-wider text-xs">Satuan</label>
                            <input type="text" name="unit" value="{{ old('unit', $inventory->unit) }}"
                                placeholder="pcs, box, dll"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm">
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('admin.dinkes.inventory.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded shadow transition text-sm">
                            Batal
                        </a>
                        <button type="submit"
                            class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded shadow-lg transition text-sm">
                            Perbarui Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>