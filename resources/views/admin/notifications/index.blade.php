<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Page Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h2 class="text-3xl font-black text-gray-800">Broadcast <span
                            class="text-purple-600">Notification</span></h2>
                    <p class="text-gray-500 mt-1">Kirim pesan penting ke seluruh pengguna atau target tertentu.</p>
                </div>
                <a href="{{ route('admin.notifications.create') }}"
                    class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 flex items-center gap-2 transform hover:-translate-y-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Kirim Broadcast Baru
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
                        <span class="w-1.5 h-8 bg-purple-600 rounded-full inline-block"></span>
                        Riwayat Broadcast
                    </h3>
                </div>

                <div class="p-8">
                    @if ($notifications->isEmpty())
                        <div class="text-center py-16">
                            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                                <span class="text-4xl">📭</span>
                            </div>
                            <h4 class="text-xl font-bold text-gray-800">Belum ada broadcast</h4>
                            <p class="text-gray-500 mt-2">Mulai kirim notifikasi penting kepada pengguna sistem.</p>
                            <a href="{{ route('admin.notifications.create') }}"
                                class="mt-6 inline-block text-purple-600 font-bold hover:underline">
                                + Buat Broadcast Sekarang
                            </a>
                        </div>
                    @else
                        <div class="grid gap-6">
                            @foreach ($notifications as $notification)
                                <div
                                    class="group border border-gray-100 rounded-2xl p-6 hover:shadow-md hover:border-purple-100 transition duration-300 bg-gray-50 hover:bg-white">
                                    <div class="flex flex-col md:flex-row justify-between items-start gap-4">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-3 mb-2">
                                                <h4
                                                    class="font-bold text-gray-800 text-lg group-hover:text-purple-600 transition">
                                                    {{ $notification->title }}</h4>
                                                <span class="text-xs font-bold px-2 py-1 rounded bg-gray-200 text-gray-600">
                                                    {{ $notification->target_role ? ucfirst($notification->target_role) : 'All Users' }}
                                                </span>
                                            </div>
                                            <p class="text-gray-600 leading-relaxed">{{ $notification->message }}</p>

                                            <div class="flex items-center gap-4 mt-4 text-sm text-gray-400">
                                                <div class="flex items-center gap-1.5">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                        </path>
                                                    </svg>
                                                    <span>{{ $notification->sender->name }}</span>
                                                </div>
                                                <div class="flex items-center gap-1.5">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                    <span>{{ $notification->created_at->format('d M Y, H:i') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Pagination if needed -->
                @if(method_exists($notifications, 'links'))
                    <div class="bg-gray-50 px-8 py-5 border-t border-gray-100">
                        {{ $notifications->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>