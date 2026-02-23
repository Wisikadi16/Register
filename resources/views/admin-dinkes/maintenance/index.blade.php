<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Maintenance & Service') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Form Tambah Maintenance --}}
                <div class="mb-8 p-4 bg-gray-50 rounded-lg border">
                    <h3 class="text-lg font-bold mb-4">Jadwalkan Maintenance Baru</h3>
                    <form action="{{ route('admin.dinkes.maintenance.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tipe</label>
                                <select name="type"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="service_rutin">Service Rutin Ambulan</option>
                                    <option value="kerusakan">Perbaikan Kerusakan</option>
                                    <option value="kalibrasi">Kalibrasi Alat Medis</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal Jadwal</label>
                                <input type="date" name="scheduled_date"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Ambulan (Opsional)</label>
                                <select name="ambulance_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">-- Pilih Ambulan --</option>
                                    @foreach($ambulances as $amb)
                                        <option value="{{ $amb->id }}">{{ $amb->name }} ({{ $amb->plat_number }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Alat Medis (Opsional)</label>
                                <select name="inventory_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">-- Pilih Alat --</option>
                                    @foreach($inventories as $inv)
                                        <option value="{{ $inv->id }}">{{ $inv->name }} ({{ $inv->condition }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Deskripsi / Keluhan</label>
                            <textarea name="description" rows="2"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required></textarea>
                        </div>
                        <div class="mt-4 text-right">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                + Jadwalkan
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Tabel Daftar Maintenance --}}
                <h3 class="text-lg font-bold mb-4">Daftar Jadwal & Riwayat</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Unit / Alat</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jenis & Deskripsi</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Biaya</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($maintenances as $m)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $m->scheduled_date->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($m->ambulance)
                                            <span class="font-bold">🚑 {{ $m->ambulance->name }}</span>
                                        @elseif($m->inventory)
                                            <span class="font-bold">🩺 {{ $m->inventory->name }}</span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <div class="font-bold capitalize">{{ str_replace('_', ' ', $m->type) }}</div>
                                        <div class="text-gray-500 text-xs">{{ $m->description }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($m->status == 'completed')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Selesai
                                            </span>
                                        @elseif($m->status == 'overdue')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Terlewat
                                            </span>
                                        @else
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Terjadwal
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        Rp {{ number_format($m->cost, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        @if($m->status != 'completed')
                                            <button onclick="openCompleteModal('{{ $m->id }}')"
                                                class="text-green-600 hover:text-green-900 mr-3">✅ Selesai</button>
                                        @endif
                                        <form action="{{ route('admin.dinkes.maintenance.destroy', $m->id) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">🗑️ Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data maintenance.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Selesaikan Maintenance --}}
    <div id="completeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Lapor Pengerjaan Selesai</h3>
                <form id="completeForm" method="POST" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="completed">

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Biaya Pengerjaan (Rp)</label>
                        <input type="number" name="cost" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Foto Bukti / Nota (Opsional)</label>
                        <input type="file" name="proof_image" class="mt-1 block w-full text-sm">
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeCompleteModal()"
                            class="bg-gray-300 hover:bg-gray-400 text-black py-2 px-4 rounded">Batal</button>
                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openCompleteModal(id) {
            document.getElementById('completeModal').classList.remove('hidden');
            let form = document.getElementById('completeForm');
            form.action = `/admin/maintenance/${id}`;
        }

        function closeCompleteModal() {
            document.getElementById('completeModal').classList.add('hidden');
        }
    </script>
</x-app-layout>