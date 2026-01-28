<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🏥 Tambah Puskesmas Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.basecamps.store') }}">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Nama Puskesmas')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="phone" :value="__('Nomor Telepon')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" required />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <x-input-label for="latitude" :value="__('Latitude (Koordinat)')" />
                            <x-text-input id="latitude" class="block mt-1 w-full" type="text" name="latitude"
                                required />
                            <p class="text-xs text-gray-500 mt-1">Contoh: -6.986687</p>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="longitude" :value="__('Longitude (Koordinat)')" />
                            <x-text-input id="longitude" class="block mt-1 w-full" type="text" name="longitude"
                                required />
                            <p class="text-xs text-gray-500 mt-1">Contoh: 110.413254</p>
                        </div>
                    </div>

                    <div class="flex justify-between mt-6 border-t pt-4">
                        <a href="{{ route('admin.basecamps.index') }}"
                            class="text-gray-600 hover:text-gray-900 font-bold py-2 px-4 rounded">
                            &larr; Kembali
                        </a>
                        <x-primary-button>
                            {{ __('Simpan Puskesmas') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>