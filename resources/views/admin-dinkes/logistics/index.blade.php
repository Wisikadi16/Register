<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            🚑 Logistik Armada (Pengajuan Service & BBM)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Submit Logistics Form -->
            <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-blue-600">
                <h3 class="font-bold text-lg mb-4 text-blue-700">Submit Logistik Kendaraan</h3>
                <form action="{{ route('admin.dinkes.logistics.store') }}" method="POST"
                    class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end text-sm">
                    @csrf
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Pilih Ambulans</label>
                        <select name="ambulance_id" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @foreach($ambulances as $amb)
                                <option value="{{ $amb->id }}">{{ $amb->name }} ({{ $amb->plat_number }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Jenis Pengajuan</label>
                        <select name="type" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="service">Service Kendaraan</option>
                            <option value="fuel">Pengajuan BBM</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Biaya (Amount)</label>
                        <input type="number" name="amount" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" name="request_date" required value="{{ date('Y-m-d') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transition">
                        Ajukan Logistik
                    </button>
                    <div class="md:col-span-5 mt-2">
                        <label class="block font-medium text-gray-700 mb-1">Keterangan Tambahan</label>
                        <textarea name="description" rows="2"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                    </div>
                </form>
            </div>

            <!-- Logistics List -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 uppercase tracking-wider text-xs font-bold text-gray-500">
                            <tr>
                                <th class="px-6 py-4 text-left">Tanggal</th>
                                <th class="px-6 py-4 text-left">Ambulans</th>
                                <th class="px-6 py-4 text-left">Jenis</th>
                                <th class="px-6 py-4 text-left">Keterangan</th>
                                <th class="px-6 py-4 text-right">Biaya</th>
                                <th class="px-6 py-4 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-sm">
                            @forelse($logistics as $log)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($log->request_date)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-900">{{ $log->ambulance->name }}</td>
                                    <td class="px-6 py-4 uppercase font-bold text-xs">{{ $log->type }}</td>
                                    <td class="px-6 py-4 text-gray-600 italic">{{ $log->description ?: '-' }}</td>
                                    <td class="px-6 py-4 text-right font-bold text-blue-600">Rp
                                        {{ number_format($log->amount, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="px-2 py-1 text-xs rounded-full font-bold bg-blue-100 text-blue-700 uppercase">
                                            {{ $log->status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-500 italic">Belum ada riwayat
                                        logistik.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>