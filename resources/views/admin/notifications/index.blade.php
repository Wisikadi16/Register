<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center w-full">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                <span class="text-purple-600">Broadcast</span> Notification
            </h2>
            <div class="mt-2 md:mt-0">
                <a href="{{ route('admin.notifications.create') }}"
                    class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                    ➕ Kirim Broadcast Baru
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Riwayat Broadcast</h3>

                    @if ($notifications->isEmpty())
                        <div class="text-center py-12 text-gray-500">
                            <span class="text-5xl">📭</span>
                            <p class="mt-4">Belum ada broadcast yang dikirim</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($notifications as $notification)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h4 class="font-bold text-gray-800 text-lg">{{ $notification->title }}</h4>
                                            <p class="text-gray-600 mt-2">{{ $notification->message }}</p>
                                            <div class="flex gap-4 mt-3 text-sm text-gray-500">
                                                <span>👤 {{ $notification->sender->name }}</span>
                                                <span>🎯 Target:
                                                    <strong>{{ $notification->target_role ? ucfirst($notification->target_role) : 'Semua User' }}</strong></span>
                                                <span>📅 {{ $notification->created_at->format('d M Y, H:i') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>