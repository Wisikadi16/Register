<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Edit Data Ambulan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.ambulances.update', $ambulance->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Kolom Kiri: Identitas -->
                        <div class="col-span-1">
                            <div class="mb-4">
                                <x-input-label for="name" :value="__('Nama Unit Ambulan')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    :value="old('name', $ambulance->name)" required autofocus />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="plat_number" :value="__('Nomor Polisi (Plat)')" />
                                <x-text-input id="plat_number" class="block mt-1 w-full" type="text" name="plat_number"
                                    :value="old('plat_number', $ambulance->plat_number)" required />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="status" :value="__('Status Saat Ini')" />
                                <select name="status" id="status"
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="ready" {{ $ambulance->status == 'ready' ? 'selected' : '' }}>Ready
                                        (Siap)</option>
                                    <option value="maintenance" {{ $ambulance->status == 'maintenance' ? 'selected' : '' }}>Maintenance (Perbaikan)</option>
                                    <option value="busy" {{ $ambulance->status == 'busy' ? 'selected' : '' }}>Busy (Sedang
                                        Bertugas)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Kolom Kanan: Penugasan -->
                        <div class="col-span-1">
                            <div class="mb-4">
                                <x-input-label for="basecamp_id" :value="__('Lokasi Basecamp (Wajib)')" />
                                <select name="basecamp_id" id="basecamp_id"
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required>
                                    <option value="" disabled>-- Pilih Puskesmas --</option>
                                    @foreach($basecamps as $basecamp)
                                        <option value="{{ $basecamp->id }}" {{ $ambulance->basecamp_id == $basecamp->id ? 'selected' : '' }}>{{ $basecamp->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <x-input-label for="driver_id" :value="__('Driver Penanggung Jawab')" />
                                <select name="driver_id" id="driver_id"
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">-- Belum Ada Driver --</option>
                                    @foreach($drivers as $driver)
                                        <option value="{{ $driver->id }}" {{ $ambulance->driver_id == $driver->id ? 'selected' : '' }}>{{ $driver->name }} ({{ $driver->email }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="flex justify-between mt-6 border-t pt-4">
                        <a href="{{ route('admin.ambulances.index') }}"
                            class="text-gray-600 hover:text-gray-900 font-bold py-2 px-4 rounded">
                            &larr; Kembali
                        </a>
                        <x-primary-button>
                            {{ __('Update Ambulan') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>