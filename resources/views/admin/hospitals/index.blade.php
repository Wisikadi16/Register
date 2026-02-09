<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Page Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h2 class="text-3xl font-black text-gray-800">Data Rumah Sakit</h2>
                    <p class="text-gray-500 mt-1">Kelola data RS Rujukan dan update ketersediaan bed.</p>
                </div>
                <div class="flex gap-3">
                    <button onclick="document.getElementById('importModal').classList.remove('hidden')"
                        class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-2.5 px-5 rounded-xl shadow-sm hover:shadow-md transition duration-300 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                        </svg>
                        Import
                    </button>
                    <a href="{{ route('admin.hospitals.create') }}"
                        class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2.5 px-5 rounded-xl shadow-lg hover:shadow-xl transition duration-300 flex items-center gap-2 transform hover:-translate-y-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah RS
                    </a>
                </div>
            </div>

            <!-- Content Card -->
            <div class="bg-white overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300 rounded-[2rem] border border-gray-100">
                <div class="p-8 bg-white border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-3">
                        <span class="w-1.5 h-8 bg-purple-600 rounded-full inline-block"></span>
                        Daftar Fasilitas Kesehatan
                    </h3>
                    <div class="flex gap-2">
                         <a href="{{ route('admin.hospitals.export') }}"
                            class="text-green-600 hover:text-green-800 font-bold text-sm bg-green-50 hover:bg-green-100 px-4 py-2 rounded-xl transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Export Excel
                         </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-8 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Nama & Alamat</th>
                                <th class="px-6 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Kontak IGD</th>
                                <th class="px-6 py-5 text-center text-xs font-bold text-gray-400 uppercase tracking-wider">Bed IGD</th>
                                <th class="px-6 py-5 text-center text-xs font-bold text-gray-400 uppercase tracking-wider">Bed ICU</th>
                                <th class="px-8 py-5 text-center text-xs font-bold text-gray-400 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($hospitals as $rs)
                                <tr class="hover:bg-purple-50/50 transition duration-200 group">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-4">
                                            <div class="p-2 bg-purple-50 rounded-xl text-purple-600 group-hover:bg-purple-100 transition">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-sm font-bold text-gray-900 group-hover:text-purple-600 transition">{{ $rs->name }}</div>
                                                <div class="text-xs text-gray-500 mt-0.5">{{ Str::limit($rs->address, 50) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-700">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                            {{ $rs->phone_igd }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-lg {{ $rs->available_bed_igd > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $rs->available_bed_igd }} Tersedia
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-lg {{ $rs->available_bed_icu > 0 ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $rs->available_bed_icu }} Tersedia
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 whitespace-nowrap text-center text-sm font-medium">
                                        <div class="flex justify-center items-center gap-2">
                                            <a href="{{ route('admin.hospitals.edit', $rs->id) }}"
                                                class="w-8 h-8 rounded-lg bg-gray-50 text-gray-400 hover:bg-purple-50 hover:text-purple-600 flex items-center justify-center transition duration-200" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.hospitals.destroy', $rs->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin hapus data RS ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-8 h-8 rounded-lg bg-gray-50 text-gray-400 hover:bg-red-50 hover:text-red-600 flex items-center justify-center transition duration-200" title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center text-gray-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                            </div>
                                            <p class="text-lg font-bold text-gray-600">Belum ada data Rumah Sakit</p>
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

    <!-- Import Modal -->
    <div id="importModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 overflow-y-auto h-full w-full z-50 backdrop-blur-sm transition-all duration-300">
        <div class="relative top-20 mx-auto p-0 border-0 w-96 shadow-2xl rounded-2xl bg-white overflow-hidden transform transition-all scale-100">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800">Import Data Rumah Sakit</h3>
                <button onclick="document.getElementById('importModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <div class="p-6">
                <form action="{{ route('admin.hospitals.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Upload File Excel/CSV</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:bg-gray-50 transition cursor-pointer">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-purple-600 hover:text-purple-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-purple-500">
                                        <span>Upload a file</span>
                                        <input id="file-upload" name="file" type="file" class="sr-only" accept=".xlsx,.xls,.csv" required>
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">XLSX, XLS, CSV up to 10MB</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="document.getElementById('importModal').classList.add('hidden')"
                            class="px-5 py-2.5 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2.5 bg-purple-600 text-white font-bold rounded-xl hover:bg-purple-700 shadow-lg hover:shadow-xl transition">
                            Process Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>