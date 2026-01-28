<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Edit Data Puskesmas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.basecamps.update', $basecamp->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Nama Puskesmas')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $basecamp->name)" required autofocus />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="phone" :value="__('Nomor Telepon')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone', $basecamp->phone)" required />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <x-input-label for="latitude" :value="__('Latitude (Koordinat)')" />
                            <x-text-input id="latitude" class="block mt-1 w-full" type="text" name="latitude"
                                :value="old('latitude', $basecamp->latitude)" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="longitude" :value="__('Longitude (Koordinat)')" />
                            <x-text-input id="longitude" class="block mt-1 w-full" type="text" name="longitude"
                                :value="old('longitude', $basecamp->longitude)" required />
                        </div>
                    </div>

                    <div class="flex justify-between mt-6 border-t pt-4">
                        <a href="{{ route('admin.basecamps.index') }}"
                            class="text-gray-600 hover:text-gray-900 font-bold py-2 px-4 rounded">
                            &larr; Kembali
                        </a>
                        <x-primary-button>
                            {{ __('Update Puskesmas') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>