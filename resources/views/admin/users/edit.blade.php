<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Edit User: {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Nama Lengkap / Instansi')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name', $user->name)" required autofocus />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email Login')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email', $user->email)" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="role" :value="__('Jabatan / Role')" />
                        <select name="role" id="role"
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="" disabled>-- Pilih Role --</option>

                            <optgroup label="Pengelola Utama">
                                <option value="super_admin" {{ $user->role == 'super_admin' ? 'selected' : '' }}>Super
                                    Admin (IT Pusat)</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin (Dinas
                                    Kesehatan)</option>
                                <option value="operator" {{ $user->role == 'operator' ? 'selected' : '' }}>Operator
                                    (Call Center)</option>
                            </optgroup>

                            <optgroup label="Tim Lapangan">
                                <option value="driver" {{ $user->role == 'driver' ? 'selected' : '' }}>Driver Ambulan
                                </option>
                                <option value="nakes" {{ $user->role == 'nakes' ? 'selected' : '' }}>Tenaga Medis
                                    (Nakes)</option>
                            </optgroup>

                            <optgroup label="Fasilitas Kesehatan">
                                <option value="rumahsakit" {{ $user->role == 'rumahsakit' ? 'selected' : '' }}>Admin
                                    Rumah Sakit</option>
                                <option value="puskesmas" {{ $user->role == 'puskesmas' ? 'selected' : '' }}>Admin
                                    Puskesmas</option>
                                <option value="dokter" {{ $user->role == 'dokter' ? 'selected' : '' }}>Dokter Konsultan
                                </option>
                            </optgroup>

                            <optgroup label="Instansi Terkait">
                                <option value="polisi" {{ $user->role == 'polisi' ? 'selected' : '' }}>Kepolisian (Laka
                                    Lantas)</option>
                                <option value="damkar" {{ $user->role == 'damkar' ? 'selected' : '' }}>Pemadam Kebakaran
                                </option>
                                <option value="bpbd" {{ $user->role == 'bpbd' ? 'selected' : '' }}>BPBD (Bencana)
                                </option>
                                <option value="basarnas" {{ $user->role == 'basarnas' ? 'selected' : '' }}>BASARNAS
                                </option>
                                <option value="dishub" {{ $user->role == 'dishub' ? 'selected' : '' }}>DISHUB</option>
                            </optgroup>

                            <optgroup label="Pengguna">
                                <option value="masyarakat" {{ $user->role == 'masyarakat' ? 'selected' : ''
                                    }}>Masyarakat Umum</option>
                            </optgroup>
                        </select>
                    </div>

                    <div class="bg-gray-100 p-4 rounded-lg mb-4">
                        <h4 class="text-sm font-bold text-gray-700 mb-2">Ganti Password (Opsional)</h4>
                        <p class="text-xs text-gray-500 mb-2">Kosongkan jika tidak ingin mengubah password.</p>

                        <div class="mb-2">
                            <x-input-label for="password" :value="__('Password Baru')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" />
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" :value="__('Ulangi Password')" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" />
                        </div>
                    </div>

                    <div class="flex justify-between mt-6">
                        <a href="{{ route('admin.users.index') }}"
                            class="text-gray-600 hover:text-gray-900 font-bold py-2 px-4 rounded">
                            &larr; Kembali
                        </a>
                        <x-primary-button>
                            {{ __('Update User') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>