<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Page Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h2 class="text-3xl font-black text-gray-800">Pengaturan <span class="text-blue-600">Sistem</span>
                    </h2>
                    <p class="text-gray-500 mt-1">Konfigurasi parameter global aplikasi SOS Warga.</p>
                </div>
            </div>

            @if (session('success'))
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

            <!-- Settings Form Card -->
            <div
                class="bg-white overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300 rounded-[2rem] border border-gray-100">
                <div class="bg-gradient-to-r from-blue-600 to-rose-700 p-8 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-bl-[100%]"></div>
                    <h3 class="text-xl font-bold text-white relative z-10">Konfigurasi Aplikasi</h3>
                    <p class="text-blue-100 mt-1 relative z-10 text-sm">Sesuaikan pengaturan dasar sistem sesuai
                        kebutuhan.</p>
                </div>

                <form method="POST" action="{{ route('admin.settings.update') }}" class="p-8">
                    @csrf
                    @method('PUT')

                    <div class="space-y-8">
                        @foreach ($settings as $setting)
                            <div class="group">
                                <label
                                    class="block text-sm font-bold text-gray-700 mb-2 group-hover:text-blue-600 transition">
                                    {{ $setting->label ?? ucwords(str_replace('_', ' ', $setting->key)) }}
                                </label>

                                @if ($setting->type == 'textarea')
                                    <textarea name="settings[{{ $setting->key }}]" rows="3"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition duration-200 bg-gray-50 focus:bg-white">{{ $setting->value }}</textarea>
                                @elseif ($setting->type == 'number')
                                    <input type="number" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition duration-200 bg-gray-50 focus:bg-white">
                                @else
                                    <input type="text" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition duration-200 bg-gray-50 focus:bg-white">
                                @endif

                                <div class="flex items-center gap-2 mt-2">
                                    <code
                                        class="text-xs bg-gray-100 text-gray-500 px-2 py-1 rounded border border-gray-200">Key: {{ $setting->key }}</code>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-10 pt-6 border-t border-gray-100 flex justify-end gap-3">
                        <a href="{{ route('admin.dashboard') }}"
                            class="px-6 py-3 border border-gray-200 rounded-xl text-gray-600 font-bold hover:bg-gray-50 transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5">
                            💾 Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Database Backup Section -->
            <div class="bg-gray-900 rounded-[2rem] overflow-hidden shadow-lg relative">
                <div class="absolute top-0 right-0 w-64 h-64 bg-gray-800 rounded-bl-[100%] opacity-50"></div>
                <div class="p-8 relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
                    <div>
                        <h3 class="text-xl font-bold text-white">Pemeliharaan Database</h3>
                        <p class="text-gray-400 mt-1 text-sm">Backup data sistem secara berkala untuk keamanan.</p>
                    </div>
                    <div>
                        <button disabled
                            class="bg-gray-700 text-gray-400 font-bold py-3 px-6 rounded-xl cursor-not-allowed border border-gray-600 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            Coming Soon
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>