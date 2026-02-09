<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Page Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h2 class="text-3xl font-black text-gray-800">Data Puskesmas (Basecamp)</h2>
                    <p class="text-gray-500 mt-1">Kelola titik lokasi standby ambulan dan posko kesehatan.</p>
                </div>
                <a href="{{ route('admin.basecamps.create') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 flex items-center gap-2 transform hover:-translate-y-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Puskesmas
                </a>
            </div>

            <!-- Notification -->
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition.duration.300ms
                    class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl shadow-sm flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="bg-green-100 p-2 rounded-full text-green-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                        <span class="font-bold">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-green-400 hover:text-green-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
            @endif

            <!-- Content Card -->
            <div
                class="bg-white overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300 rounded-[2rem] border border-gray-100">
                <div
                    class="p-8 bg-white border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-3">
                        <span class="w-1.5 h-8 bg-indigo-600 rounded-full inline-block"></span>
                        Daftar Basecamp Ambulan
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">
                                    No</th>
                                <th
                                    class="px-8 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">
                                    Nama Puskesmas</th>
                                <th
                                    class="px-6 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">
                                    Telepon</th>
                                <th
                                    class="px-6 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">
                                    Koordinat Lokasi</th>
                                <th
                                    class="px-8 py-5 text-center text-xs font-bold text-gray-400 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($basecamps as $index => $basecamp)
                                <tr class="hover:bg-indigo-50/50 transition duration-200 group">
                                    <td class="px-6 py-5 whitespace-nowrap text-sm font-bold text-gray-500">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-8 py-5 whitespace-nowrap">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="p-2 bg-indigo-50 rounded-xl text-indigo-600 group-hover:bg-indigo-100 transition">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                    </path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                            </div>
                                            <div
                                                class="text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition">
                                                {{ $basecamp->name }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-700">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                                </path>
                                            </svg>
                                            {{ $basecamp->phone }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div
                                            class="text-xs bg-gray-100 rounded-lg p-2 font-mono text-gray-600 border border-gray-200 inline-block">
                                            <div>Lat: {{ $basecamp->latitude }}</div>
                                            <div>Lng: {{ $basecamp->longitude }}</div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 whitespace-nowrap text-center text-sm font-medium">
                                        <div class="flex justify-center items-center gap-2">
                                            <a href="{{ route('admin.basecamps.edit', $basecamp->id) }}"
                                                class="w-8 h-8 rounded-lg bg-gray-50 text-gray-400 hover:bg-indigo-50 hover:text-indigo-600 flex items-center justify-center transition duration-200"
                                                title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.basecamps.destroy', $basecamp->id) }}"
                                                method="POST" onsubmit="return confirm('Yakin hapus data Puskesmas ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-8 h-8 rounded-lg bg-gray-50 text-gray-400 hover:bg-red-50 hover:text-red-600 flex items-center justify-center transition duration-200"
                                                    title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
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
                                            <div
                                                class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                    </path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                            </div>
                                            <p class="text-lg font-bold text-gray-600">Belum ada data Puskesmas</p>
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
</x-app-layout>