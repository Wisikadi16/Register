<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            👤 Tambah User Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Nama Lengkap / Instansi')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email Login')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="role" :value="__('Jabatan / Role')" />
                        <select name="role" id="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="" disabled selected>-- Pilih Role --</option>
                            
                            <optgroup label="Pengelola Utama">
                                <option value="super_admin">Super Admin (IT Pusat)</option>
                                <option value="admin">Admin (Dinas Kesehatan)</option>
                                <option value="operator">Operator (Call Center)</option>
                            </optgroup>

                            <optgroup label="Tim Lapangan">
                                <option value="driver">Driver Ambulan</option>
                                <option value="nakes">Tenaga Medis (Nakes)</option>
                            </optgroup>

                            <optgroup label="Fasilitas Kesehatan">
                                <option value="rumahsakit">Admin Rumah Sakit</option>
                                <option value="puskesmas">Admin Puskesmas</option>
                                <option value="dokter">Dokter Konsultan</option>
                            </optgroup>

                            <optgroup label="Instansi Terkait">
                                <option value="polisi">Kepolisian (Laka Lantas)</option>
                                <option value="damkar">Pemadam Kebakaran</option>
                                <option value="bpbd">BPBD (Bencana)</option>
                                <option value="basarnas">BASARNAS</option>
                                <option value="dishub">DISHUB</option>
                            </optgroup>

                             <optgroup label="Pengguna">
                                <option value="masyarakat">Masyarakat Umum</option>
                            </optgroup>
                        </select>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="password_confirmation" :value="__('Ulangi Password')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                    </div>

                    <div class="flex justify-end mt-4">
                        <x-primary-button>
                            {{ __('Simpan User Baru') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>