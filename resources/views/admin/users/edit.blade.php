<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Edit Data Pengguna
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Header Form -->
                <div class="mb-6 border-b pb-4">
                    <h3 class="text-lg font-bold text-gray-700">Update Informasi Akun: {{ $user->name }}</h3>
                    <p class="text-sm text-gray-500">Pastikan data yang dimasukkan sudah benar sesuai dengan peran aktor.</p>
                </div>

                <!-- Perbaikan: Nama route diubah menjadi admin.users.update agar sinkron dengan web.php -->
                <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama -->
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Nama Lengkap / Instansi')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name', $user->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <x-input-label for="email" :value="__('Email Login')" />
                            <x-text-input id="email" class="block mt-1 w-full bg-gray-50" type="email" name="email"
                                :value="old('email', $user->email)" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Role / Jabatan -->
                        <div class="mb-4">
                            <x-input-label for="role" :value="__('Role / Jabatan Sistem')" />
                            <select name="role" id="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="super_admin" {{ $user->role == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin Dinkes</option>
                                <option value="driver" {{ $user->role == 'driver' ? 'selected' : '' }}>Driver Ambulan</option>
                                <option value="nakes" {{ $user->role == 'nakes' ? 'selected' : '' }}>Tenaga Medis (Nakes)</option>
                                <option value="operator" {{ $user->role == 'operator' ? 'selected' : '' }}>Operator (Call Center)</option>
                                <option value="masyarakat" {{ $user->role == 'masyarakat' ? 'selected' : '' }}>Masyarakat</option>
                                <option value="rumahsakit" {{ $user->role == 'rumahsakit' ? 'selected' : '' }}>Rumah Sakit</option>
                                <option value="puskesmas" {{ $user->role == 'puskesmas' ? 'selected' : '' }}>Puskesmas</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <!-- Status Akun -->
                        <div class="mb-4">
                            <x-input-label for="status" :value="__('Status Akun')" />
                            <select name="status" id="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Non-Aktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                        <p class="text-xs text-yellow-700 italic">
                            * Kosongkan kolom password jika tidak ingin mengganti password user.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                            <div>
                                <x-input-label for="password" :value="__('Password Baru (Opsional)')" />
                                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
                            </div>
                            <div>
                                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" />
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-8 gap-4">
                        <!-- Perbaikan: Route index menggunakan admin.users.index -->
                        <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                            {{ __('Batal & Kembali') }}
                        </a>

                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Simpan Perubahan') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>