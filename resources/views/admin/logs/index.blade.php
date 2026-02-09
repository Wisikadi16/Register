<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Page Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h2 class="text-3xl font-black text-gray-800">Audit Log System</h2>
                    <p class="text-gray-500 mt-1">Rekam jejak aktivitas pengguna untuk keamanan & audit.</p>
                </div>
                <div class="bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-100 flex items-center gap-3">
                    <div class="p-2 bg-gray-50 rounded-lg text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="text-xs font-bold text-gray-600">
                        Last Activity: {{ now()->format('H:i') }}
                    </div>
                </div>
            </div>

            <!-- Content Card -->
            <div
                class="bg-white overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300 rounded-[2rem] border border-gray-100">
                <div
                    class="p-8 bg-white border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-3">
                        <span class="w-1.5 h-8 bg-gray-600 rounded-full inline-block"></span>
                        Log Aktivitas Terbaru
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-8 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">
                                    Waktu</th>
                                <th
                                    class="px-6 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">
                                    User (Pelaku)</th>
                                <th
                                    class="px-6 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">
                                    Aksi</th>
                                <th
                                    class="px-6 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">
                                    Deskripsi</th>
                                <th
                                    class="px-8 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">
                                    IP Address</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($logs as $log)
                                <tr class="hover:bg-gray-50/50 transition duration-200 group">
                                    <td class="px-8 py-5 whitespace-nowrap text-sm text-gray-500 font-mono">
                                        {{ $log->created_at->format('d M Y H:i:s') }}
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="text-sm font-bold text-gray-800 group-hover:text-blue-600 transition">
                                            {{ $log->user->name ?? 'Unknown' }}
                                        </div>
                                        <div class="text-xs text-gray-400">{{ $log->user->role ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm">
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-lg 
                                                {{ $log->action == 'CREATE' ? 'bg-green-100 text-green-700' : '' }}
                                                {{ $log->action == 'UPDATE' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                                {{ $log->action == 'DELETE' ? 'bg-red-100 text-red-700' : '' }}
                                                {{ $log->action == 'LOGIN' ? 'bg-blue-100 text-blue-700' : '' }}
                                                {{ !in_array($log->action, ['CREATE', 'UPDATE', 'DELETE', 'LOGIN']) ? 'bg-gray-100 text-gray-600' : '' }}">
                                            {{ $log->action }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-sm text-gray-700 leading-relaxed">
                                        {{ $log->description }}
                                    </td>
                                    <td class="px-8 py-5 whitespace-nowrap text-xs text-gray-400 font-mono">
                                        {{ $log->ip_address }}
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
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <p class="text-lg font-bold text-gray-600">Belum ada aktivitas tercatat</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-gray-50 px-8 py-5 border-t border-gray-100">
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>