<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            ✏️ Edit Logistik Kendaraan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-blue-600">
                <form action="{{ route('admin.dinkes.logistics.update', $logistic->id) }}" method="POST"
                    class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Pilih Ambulans</label>
                        <select name="ambulance_id" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @foreach($ambulances as $amb)
                                <option value="{{ $amb->id }}" {{ $logistic->ambulance_id == $amb->id ? 'selected' : '' }}>
                                    {{ $amb->name }} ({{ $amb->plat_number }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Jenis Pengajuan</label>
                        <select name="type" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="service" {{ $logistic->type == 'service' ? 'selected' : '' }}>Service Kendaraan
                            </option>
                            <option value="fuel" {{ $logistic->type == 'fuel' ? 'selected' : '' }}>Pengajuan BBM</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Biaya (Amount)</label>
                        <input type="number" name="amount" value="{{ old('amount', $logistic->amount) }}" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" name="request_date"
                            value="{{ old('request_date', $logistic->request_date) }}" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Keterangan Tambahan</label>
                        <textarea name="description" rows="3"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $logistic->description) }}</textarea>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('admin.dinkes.logistics.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded shadow transition text-sm">
                            Batal
                        </a>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transition text-sm">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>