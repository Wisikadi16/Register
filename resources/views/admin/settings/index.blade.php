<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center w-full">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                <span class="text-blue-600">Pengaturan</span> Sistem
            </h2>
            <div class="mt-2 md:mt-0 text-sm text-gray-500 text-right">
                ⚙️ Konfigurasi Global
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Settings Form -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6">
                    <h3 class="text-xl font-bold text-white">Konfigurasi Aplikasi</h3>
                    <p class="text-blue-100 mt-1">Ubah parameter global sistem tanpa menyentuh kode</p>
                </div>

                <form method="POST" action="{{ route('admin.settings.update') }}" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        @foreach ($settings as $setting)
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    {{ $setting->label }}
                                </label>

                                @if ($setting->type == 'textarea')
                                    <textarea name="settings[{{ $setting->key }}]" rows="3"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ $setting->value }}</textarea>
                                @elseif ($setting->type == 'number')
                                    <input type="number" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @else
                                    <input type="text" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @endif

                                <p class="text-xs text-gray-500 mt-1">
                                    Key: <code class="bg-gray-100 px-2 py-0.5 rounded">{{ $setting->key }}</code>
                                </p>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 flex justify-end gap-3">
                        <a href="{{ route('admin.dashboard') }}"
                            class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            💾 Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Database Backup Section (Future Feature) -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden mt-6">
                <div class="bg-gradient-to-r from-gray-700 to-gray-900 p-6">
                    <h3 class="text-xl font-bold text-white">Pemeliharaan Database</h3>
                    <p class="text-gray-300 mt-1">Backup dan restore data sistem</p>
                </div>

                <div class="p-6">
                    <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-800">Backup Database</p>
                            <p class="text-sm text-gray-600 mt-1">Download file SQL dari database saat ini</p>
                        </div>
                        <button disabled
                            class="px-5 py-2 bg-gray-400 text-white rounded-lg cursor-not-allowed opacity-50">
                            🔒 Coming Soon
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>