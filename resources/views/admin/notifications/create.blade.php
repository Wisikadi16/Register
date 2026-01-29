<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center w-full">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                <span class="text-purple-600">Kirim</span> Broadcast
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-gradient-to-r from-purple-600 to-pink-600 p-6">
                    <h3 class="text-xl font-bold text-white">Buat Broadcast Notification</h3>
                    <p class="text-purple-100 mt-1">Kirim pengumuman ke semua user atau kelompok spesifik</p>
                </div>

                <form method="POST" action="{{ route('admin.notifications.store') }}" class="p-6">
                    @csrf

                    <div class="space-y-6">
                        <!-- Title -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Judul Notifikasi <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" value="{{ old('title') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                placeholder="Contoh: Pemeliharaan Sistem">
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Message -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Isi Pesan <span class="text-red-500">*</span>
                            </label>
                            <textarea name="message" rows="5" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                placeholder="Tulis pesan broadcast...">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Target Role -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Target Penerima
                            </label>
                            <select name="target_role"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                <option value="all">📢 Semua Pengguna</option>
                                <option value="driver">🚗 Driver Saja</option>
                                <option value="nakes">⚕️ Nakes Saja</option>
                                <option value="operator">📞 Operator Saja</option>
                                <option value="admin">👨‍💼 Admin Saja</option>
                                <option value="masyarakat">👥 Masyarakat Saja</option>
                            </select>
                        </div>

                        <!-- Preview Box -->
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                            <p class="text-xs font-semibold text-gray-500 uppercase mb-2">Preview Notification</p>
                            <div class="bg-white border-l-4 border-purple-500 p-3 rounded">
                                <h4 class="font-bold text-gray-800" id="preview-title">Judul Notifikasi</h4>
                                <p class="text-gray-600 text-sm mt-1" id="preview-message">Isi pesan akan muncul di
                                    sini...</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-3">
                        <a href="{{ route('admin.notifications.index') }}"
                            class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                            📤 Kirim Broadcast
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        // Live preview
        document.querySelector('input[name="title"]').addEventListener('input', function (e) {
            document.getElementById('preview-title').textContent = e.target.value || 'Judul Notifikasi';
        });

        document.querySelector('textarea[name="message"]').addEventListener('input', function (e) {
            document.getElementById('preview-message').textContent = e.target.value || 'Isi pesan akan muncul di sini...';
        });
    </script>
</x-app-layout>