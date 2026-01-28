<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🏥 Tambah Rumah Sakit Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.hospitals.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Kolom Kiri -->
                        <div class="col-span-1">
                            <div class="mb-4">
                                <x-input-label for="name" :value="__('Nama Rumah Sakit')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required
                                    autofocus />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="phone_igd" :value="__('Nomor Telepon IGD')" />
                                <x-text-input id="phone_igd" class="block mt-1 w-full" type="text" name="phone_igd"
                                    required />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="address" :value="__('Alamat Lengkap')" />
                                <textarea name="address" id="address" rows="3"
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required></textarea>
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-span-1">
                            <div class="mb-4">
                                <x-input-label for="latitude" :value="__('Latitude (Koordinat)')" />
                                <x-text-input id="latitude" class="block mt-1 w-full" type="text" name="latitude"
                                    required />
                                <p class="text-xs text-gray-500 mt-1">Contoh: -6.993478</p>
                            </div>

                            <div class="mb-4">
                                <x-input-label for="longitude" :value="__('Longitude (Koordinat)')" />
                                <x-text-input id="longitude" class="block mt-1 w-full" type="text" name="longitude"
                                    required />
                                <p class="text-xs text-gray-500 mt-1">Contoh: 110.408546</p>
                            </div>

                            <div class="flex gap-4">
                                <div class="w-1/2 mb-4">
                                    <x-input-label for="available_bed_igd" :value="__('Bed IGD')" />
                                    <x-text-input id="available_bed_igd" class="block mt-1 w-full" type="number"
                                        name="available_bed_igd" value="0" required />
                                </div>
                                <div class="w-1/2 mb-4">
                                    <x-input-label for="available_bed_icu" :value="__('Bed ICU')" />
                                    <x-text-input id="available_bed_icu" class="block mt-1 w-full" type="number"
                                        name="available_bed_icu" value="0" required />
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="flex justify-between mt-6 border-t pt-4">
                        <a href="{{ route('admin.hospitals.index') }}"
                            class="text-gray-600 hover:text-gray-900 font-bold py-2 px-4 rounded">
                            &larr; Kembali
                        </a>
                        <x-primary-button>
                            {{ __('Simpan Data RS') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>