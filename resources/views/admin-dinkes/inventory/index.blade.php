<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Page Header -->
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Manajemen Inventori</h2>
                    <p class="text-slate-500 mt-1">Monitoring stok alkes, obat, dan kebutuhan operasional.</p>
                </div>
                <div class="hidden md:flex gap-3">
                     <!-- Date/Time or extra action can go here -->
                </div>
            </div>

            <!-- Stats Overview Cards (Medical Dashboard Style) -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Total Barang -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex items-center gap-4 hover:shadow-lg hover:border-blue-200 transition group">
                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 text-2xl group-hover:scale-110 transition duration-300">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Item</p>
                        <p class="text-2xl font-black text-slate-800">{{ $inventories->count() }}</p>
                    </div>
                </div>
                
                <!-- Stok Aman -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex items-center gap-4 hover:shadow-lg hover:border-green-200 transition group">
                    <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 text-2xl group-hover:scale-110 transition duration-300">
                         <i class="fas fa-check-double"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Stok Aman</p>
                        <p class="text-2xl font-black text-slate-800">{{ $inventories->where('quantity', '>', 10)->count() }}</p>
                    </div>
                </div>

                <!-- Menipis -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex items-center gap-4 hover:shadow-lg hover:border-amber-200 transition group">
                    <div class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 text-2xl group-hover:scale-110 transition duration-300">
                         <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Menipis</p>
                        <p class="text-2xl font-black text-slate-800">{{ $inventories->where('quantity', '<=', 10)->where('quantity', '>', 0)->count() }}</p>
                    </div>
                </div>

                <!-- Habis -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex items-center gap-4 hover:shadow-lg hover:border-red-200 transition group">
                    <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center text-red-600 text-2xl group-hover:scale-110 transition duration-300">
                         <i class="fas fa-times-circle"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Habis</p>
                        <p class="text-2xl font-black text-slate-800">{{ $inventories->where('quantity', 0)->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Content Grid: Form (Left) & List (Right) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left: Quick Add Form (Expertise Card Style) -->
                <div class="bg-white p-8 rounded-[2rem] shadow-lg shadow-blue-900/5 border border-slate-100 h-fit">
                    <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-3">
                        <span class="w-10 h-10 bg-blue-100 flex items-center justify-center rounded-xl text-blue-600">
                             <i class="fas fa-plus"></i>
                        </span>
                        Tambah Barang
                    </h3>
                    
                    <form action="{{ route('admin.dinkes.inventory.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Barang</label>
                            <input type="text" name="name" required placeholder="Contoh: Masker N95"
                                class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition px-4 py-3 bg-slate-50 focus:bg-white text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Kategori</label>
                            <div class="relative">
                                <select name="category" required class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition px-4 py-3 bg-slate-50 focus:bg-white text-sm appearance-none">
                                    <option value="stock">📦 Stok Umum</option>
                                    <option value="oxygen">💨 Tabung Oksigen</option>
                                    <option value="medicine">💊 Obat-obatan</option>
                                    <option value="atk">📝 ATK (Kantor)</option>
                                    <option value="household">🏠 Rumah Tangga</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-500">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Jumlah</label>
                                <input type="number" name="quantity" required placeholder="0"
                                    class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition px-4 py-3 bg-slate-50 focus:bg-white text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Satuan</label>
                                <input type="text" name="unit" placeholder="Pcs/Box"
                                    class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition px-4 py-3 bg-slate-50 focus:bg-white text-sm">
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-blue-500/30 transition transform hover:-translate-y-1 mt-4 flex items-center justify-center gap-2">
                            <i class="fas fa-save"></i> Simpan ke Inventori
                        </button>
                    </form>
                </div>

                <!-- Right: Inventory List -->
                <div class="lg:col-span-2 bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden flex flex-col h-full">
                    <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                        <div>
                            <h3 class="text-xl font-bold text-slate-800">Daftar Stok Saat Ini</h3>
                            <p class="text-sm text-slate-400 mt-1">Update Terakhir: {{ now()->format('d M Y') }}</p>
                        </div>
                        
                        {{-- <button class="bg-white border border-slate-200 text-slate-600 px-4 py-2 rounded-xl text-sm font-bold hover:bg-slate-50 transition">
                            <i class="fas fa-filter mr-1"></i> Filter
                        </button> --}}
                    </div>
                    
                    <div class="overflow-x-auto p-2">
                        <table class="min-w-full">
                            <thead class="bg-white">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">Barang</th>
                                    <th class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">Kategori</th>
                                    <th class="px-6 py-4 text-center text-xs font-black text-slate-400 uppercase tracking-wider">Stok</th>
                                    <th class="px-6 py-4 text-center text-xs font-black text-slate-400 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($inventories as $item)
                                    <tr class="hover:bg-slate-50 transition duration-150 group">
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-slate-800 text-base">{{ $item->name }}</div>
                                            <div class="text-xs text-slate-400 font-medium">{{ $item->unit }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                $icon = match($item->category) {
                                                    'medicine' => 'fa-pills',
                                                    'oxygen' => 'fa-wind',
                                                    'atk' => 'fa-pen-nib',
                                                    'household' => 'fa-couch',
                                                    default => 'fa-box'
                                                };
                                                $color = match($item->category) {
                                                    'medicine' => 'text-red-500 bg-red-50 border-red-100',
                                                    'oxygen' => 'text-blue-500 bg-blue-50 border-blue-100',
                                                    'atk' => 'text-orange-500 bg-orange-50 border-orange-100',
                                                    'household' => 'text-purple-500 bg-purple-50 border-purple-100',
                                                    default => 'text-slate-500 bg-slate-50 border-slate-200'
                                                };
                                                $catName = match($item->category) {
                                                    'medicine' => 'Obat',
                                                    'oxygen' => 'Oksigen',
                                                    'atk' => 'ATK',
                                                    'household' => 'RT',
                                                    default => 'Umum'
                                                };
                                            @endphp
                                            <span class="px-3 py-1.5 text-xs rounded-xl font-bold border flex items-center gap-2 w-fit {{ $color }}">
                                                <i class="fas {{ $icon }}"></i> {{ $catName }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                                @if($item->quantity == 0) bg-red-100 text-red-700
                                                @elseif($item->quantity <= 10) bg-amber-100 text-amber-700
                                                @else bg-green-100 text-green-700 @endif">
                                                {{ $item->quantity }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex justify-center gap-2 opacity-50 group-hover:opacity-100 transition">
                                                <a href="{{ route('admin.dinkes.inventory.edit', $item->id) }}" class="text-blue-500 hover:text-white p-2 hover:bg-blue-500 rounded-lg transition shadow-sm" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <form action="{{ route('admin.dinkes.inventory.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus barang ini?')">
                                                    @csrf @method('DELETE')
                                                    <button class="text-red-500 hover:text-white p-2 hover:bg-red-500 rounded-lg transition shadow-sm" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-slate-400">
                                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3">
                                                 <i class="fas fa-box-open text-2xl opacity-50"></i>
                                            </div>
                                            <p class="font-medium">Belum ada data inventori.</p>
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