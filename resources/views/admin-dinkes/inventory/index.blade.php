<x-app-layout>
    <div class="py-12 bg-blue-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Page Header -->
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Manajemen Inventori</h2>
                    <p class="text-gray-500 mt-1">Monitoring stok alkes, obat, dan kebutuhan operasional.</p>
                </div>
                <div class="hidden md:flex gap-3">
                     <!-- Date/Time or extra action can go here -->
                </div>
            </div>

            <!-- Stats Overview Cards (Medical Dashboard Style) -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Total Barang -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition">
                    <div class="p-3 bg-blue-100 text-blue-600 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Item</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $inventories->count() }}</p>
                    </div>
                </div>
                
                <!-- Stok Aman -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition">
                    <div class="p-3 bg-green-100 text-green-600 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Stok Aman</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $inventories->where('quantity', '>', 10)->count() }}</p>
                    </div>
                </div>

                <!-- Menipis -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition">
                    <div class="p-3 bg-yellow-100 text-yellow-600 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Menipis</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $inventories->where('quantity', '<=', 10)->where('quantity', '>', 0)->count() }}</p>
                    </div>
                </div>

                <!-- Habis -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition">
                    <div class="p-3 bg-red-100 text-red-600 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Habis</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $inventories->where('quantity', 0)->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Content Grid: Form (Left) & List (Right) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left: Quick Add Form (Expertise Card Style) -->
                <div class="bg-white p-6 rounded-3xl shadow-lg border border-gray-100 h-fit">
                    <h3 class="text-xl font-bold text-blue-900 mb-6 flex items-center gap-2">
                        <span class="bg-blue-100 p-2 rounded-lg text-blue-600">
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </span>
                        Tambah Barang
                    </h3>
                    
                    <form action="{{ route('admin.dinkes.inventory.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Barang</label>
                            <input type="text" name="name" required placeholder="Contoh: Masker N95"
                                class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition text-sm py-2.5">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori</label>
                            <select name="category" required class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition text-sm py-2.5">
                                <option value="stock">📦 Stok Umum</option>
                                <option value="oxygen">💨 Tabung Oksigen</option>
                                <option value="medicine">💊 Obat-obatan</option>
                                <option value="atk">📝 ATK (Kantor)</option>
                                <option value="household">🏠 Rumah Tangga</option>
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Jumlah</label>
                                <input type="number" name="quantity" required placeholder="0"
                                    class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition text-sm py-2.5">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Satuan</label>
                                <input type="text" name="unit" placeholder="Pcs/Box"
                                    class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition text-sm py-2.5">
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-blue-900 hover:bg-blue-800 text-white font-bold py-3 rounded-xl shadow transition transform hover:-translate-y-0.5 mt-2">
                            Simpan ke Inventori
                        </button>
                    </form>
                </div>

                <!-- Right: Inventory List -->
                <div class="lg:col-span-2 bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                        <h3 class="text-lg font-bold text-gray-800">Daftar Stok Saat Ini</h3>
                        <div class="text-sm text-gray-500">
                            Update Terakhir: {{ now()->format('d M Y') }}
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-100">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Barang</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Kategori</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase">Stok</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($inventories as $item)
                                    <tr class="hover:bg-blue-50 transition duration-150">
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-gray-900">{{ $item->name }}</div>
                                            <div class="text-xs text-gray-400">{{ $item->unit }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                $icon = match($item->category) {
                                                    'medicine' => '💊',
                                                    'oxygen' => '💨',
                                                    'atk' => '📝',
                                                    'household' => '🏠',
                                                    default => '📦'
                                                };
                                                $catName = match($item->category) {
                                                    'medicine' => 'Obat',
                                                    'oxygen' => 'Oksigen',
                                                    'atk' => 'ATK',
                                                    'household' => 'RT',
                                                    default => 'Umum'
                                                };
                                            @endphp
                                            <span class="px-2 py-1 text-xs rounded-lg bg-gray-100 font-medium text-gray-600 border border-gray-200">
                                                {{ $icon }} {{ $catName }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold
                                                @if($item->quantity == 0) bg-red-100 text-red-800
                                                @elseif($item->quantity <= 10) bg-yellow-100 text-yellow-800
                                                @else bg-green-100 text-green-800 @endif">
                                                {{ $item->quantity }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex justify-center gap-2">
                                                <a href="{{ route('admin.dinkes.inventory.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800 p-1 bg-blue-50 rounded-lg transition" title="Edit">
                                                    ✏️
                                                </a>
                                                <form action="{{ route('admin.dinkes.inventory.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus barang ini?')">
                                                    @csrf @method('DELETE')
                                                    <button class="text-red-600 hover:text-red-800 p-1 bg-red-50 rounded-lg transition" title="Hapus">
                                                        🗑️
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-gray-500 italic">Belum ada data inventori.</td>
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