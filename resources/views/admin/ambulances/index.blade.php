<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Page Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h2 class="text-3xl font-black text-gray-800">Manajemen Ambulan</h2>
                    <p class="text-gray-500 mt-1">Kelola armada, driver bertugas, dan status operasional.</p>
                </div>
                <a href="{{ route('admin.ambulances.create') }}"
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 flex items-center gap-2 transform hover:-translate-y-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Ambulan
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
                        <span class="w-1.5 h-8 bg-green-600 rounded-full inline-block"></span>
                        Daftar Armada Ambulan
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-8 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">
                                    Unit / Plat Nomor</th>
                                <th
                                    class="px-6 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">
                                    Basecamp (Lokasi)</th>
                                <th
                                    class="px-6 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">
                                    Driver Bertugas</th>
                                <th
                                    class="px-6 py-5 text-center text-xs font-bold text-gray-400 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-8 py-5 text-center text-xs font-bold text-gray-400 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($ambulances as $amb)
                                <tr class="hover:bg-green-50/50 transition duration-200 group">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="p-2 bg-green-50 rounded-xl text-green-600 group-hover:bg-green-100 transition">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div
                                                    class="text-sm font-bold text-gray-900 group-hover:text-green-600 transition">
                                                    {{ $amb->name }}</div>
                                                <div
                                                    class="text-xs bg-gray-100 px-2 py-0.5 rounded text-gray-600 mt-1 inline-block font-mono border border-gray-200">
                                                    {{ $amb->plat_number }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-700">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span
                                                class="font-medium">{{ $amb->basecamp->name ?? 'Belum ada Basecamp' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-700">
                                        @if($amb->driver)
                                            <div class="flex items-center gap-2">
                                                <div
                                                    class="w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold">
                                                    {{ substr($amb->driver->name, 0, 1) }}
                                                </div>
                                                {{ $amb->driver->name }}
                                            </div>
                                        @else
                                            <span class="text-gray-400 italic text-xs">Tidak ada driver</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-center">
                                        @if($amb->status == 'ready')
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-lg bg-green-100 text-green-700 border border-green-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5 self-center"></span>
                                                Ready
                                            </span>
                                        @elseif($amb->status == 'busy')
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-lg bg-red-100 text-red-700 border border-red-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5 self-center"></span>
                                                Sibuk
                                            </span>
                                        @else
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-lg bg-gray-100 text-gray-700 border border-gray-200">
                                                Maintenance
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-5 whitespace-nowrap text-center text-sm font-medium">
                                        <div class="flex justify-center items-center gap-2">
                                            <a href="{{ route('admin.ambulances.edit', $amb->id) }}"
                                                class="w-8 h-8 rounded-lg bg-gray-50 text-gray-400 hover:bg-green-50 hover:text-green-600 flex items-center justify-center transition duration-200"
                                                title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.ambulances.destroy', $amb->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin hapus data Ambulan ini?');">
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
                                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                </svg>
                                            </div>
                                            <p class="text-lg font-bold text-gray-600">Belum ada data Ambulan</p>
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