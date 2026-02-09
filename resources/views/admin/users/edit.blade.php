<x-app-layout>
    <div class="py-12 bg-blue-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Edit User</h2>
                    <p class="text-gray-500 text-sm">Perbarui informasi pengguna.</p>
                </div>
                <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm flex items-center gap-1">
                    &larr; Kembali
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                <div class="p-8">
                    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Personal Info Section -->
                        <div class="mb-8">
                            <h3 class="text-lg font-bold text-blue-900 mb-4 border-b border-gray-100 pb-2 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Informasi Pribadi
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="name" :value="__('Nama Lengkap')" class="text-blue-900 font-semibold" />
                                    <x-text-input id="name" class="block mt-1 w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm" type="text" name="name" :value="old('name', $user->name)" required autofocus />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="email" :value="__('Alamat Email')" class="text-blue-900 font-semibold" />
                                    <x-text-input id="email" class="block mt-1 w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm" type="email" name="email" :value="old('email', $user->email)" required />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Role & Access Section -->
                        <div class="mb-8">
                            <h3 class="text-lg font-bold text-blue-900 mb-4 border-b border-gray-100 pb-2 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                Hak Akses & Keamanan
                            </h3>
                            
                            <div class="mb-6">
                                <x-input-label for="role" :value="__('Jabatan / Role')" class="text-blue-900 font-semibold" />
                                <div class="relative">
                                    <select name="role" id="role" class="block mt-1 w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm appearance-none cursor-pointer hover:bg-gray-50 transition">
                                        <option value="" disabled>-- Pilih Role Pengguna --</option>
                                        
                                        <optgroup label="Pengelola Utama">
                                            <option value="super_admin" {{ $user->role == 'super_admin' ? 'selected' : '' }}>Super Admin (IT Pusat)</option>
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin (Dinas Kesehatan)</option>
                                            <option value="operator" {{ $user->role == 'operator' ? 'selected' : '' }}>Operator (Call Center)</option>
                                        </optgroup>

                                        <optgroup label="Tim Lapangan">
                                            <option value="driver" {{ $user->role == 'driver' ? 'selected' : '' }}>Driver Ambulan</option>
                                            <option value="nakes" {{ $user->role == 'nakes' ? 'selected' : '' }}>Tenaga Medis (Nakes)</option>
                                        </optgroup>

                                        <optgroup label="Fasilitas Kesehatan">
                                            <option value="rumahsakit" {{ $user->role == 'rumahsakit' ? 'selected' : '' }}>Admin Rumah Sakit</option>
                                            <option value="puskesmas" {{ $user->role == 'puskesmas' ? 'selected' : '' }}>Admin Puskesmas</option>
                                        </optgroup>
                                        
                                        <optgroup label="Instansi Terkait">
                                            <option value="polisi" {{ $user->role == 'polisi' ? 'selected' : '' }}>Kepolisian</option>
                                            <option value="damkar" {{ $user->role == 'damkar' ? 'selected' : '' }}>Pemadam Kebakaran</option>
                                            <option value="bpbd" {{ $user->role == 'bpbd' ? 'selected' : '' }}>BPBD / BASARNAS</option>
                                        </optgroup>

                                        <optgroup label="Publik">
                                            <option value="masyarakat" {{ $user->role == 'masyarakat' ? 'selected' : '' }}>Masyarakat Umum</option>
                                        </optgroup>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('role')" class="mt-2" />
                            </div>
                            
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded-r-lg">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-yellow-700">
                                            Kosongkan kolom password jika tidak ingin mengubah password pengguna.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="password" :value="__('Password Baru (Opsional)')" class="text-blue-900 font-semibold" />
                                    <x-text-input id="password" class="block mt-1 w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm" type="password" name="password" autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="password_confirmation" :value="__('Ulangi Password')" class="text-blue-900 font-semibold" />
                                    <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm" type="password" name="password_confirmation" />
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" class="bg-blue-900 hover:bg-blue-800 text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                Perbarui Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>