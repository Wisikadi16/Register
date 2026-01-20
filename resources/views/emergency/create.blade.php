<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-600 leading-tight">
            {{ __('PANGGILAN DARURAT (SOS)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('emergency.store') }}">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="location" :value="__('Lokasi Kejadian')" />
                        <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" required autofocus placeholder="Contoh: Jl. Merdeka No. 10, Depan Indomaret" />
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Keterangan Darurat')" />
                        <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" rows="3" required placeholder="Contoh: Kecelakaan motor, korban tidak sadarkan diri"></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="bg-red-600 hover:bg-red-700 ml-4">
                            {{ __('KIRIM SOS SEKARANG') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>