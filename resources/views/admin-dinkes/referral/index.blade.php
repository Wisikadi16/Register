<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Validasi Rujukan Antar RS') }}
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-blue-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold text-blue-800 uppercase tracking-wider">
                                    Tanggal</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold text-blue-800 uppercase tracking-wider">
                                    Pasien</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold text-blue-800 uppercase tracking-wider">
                                    Asal & Tujuan</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold text-blue-800 uppercase tracking-wider">
                                    Diagnosa</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold text-blue-800 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold text-blue-800 uppercase tracking-wider">
                                    Aksi Validasi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($referrals as $r)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $r->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <div class="font-bold">{{ $r->patient_name }}</div>
                                        <div class="text-xs text-gray-500">NIK: {{ $r->nik }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="px-2 py-1 bg-gray-100 rounded text-xs">{{ $r->originHospital->name }}</span>
                                            <i class="fas fa-arrow-right text-gray-400"></i>
                                            <span
                                                class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs font-bold">{{ $r->destinationHospital->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $r->diagnosis }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($r->status == 'approved')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Disetujui
                                            </span>
                                        @elseif($r->status == 'rejected')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Ditolak
                                            </span>
                                        @else
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 animate-pulse">
                                                Menunggu
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        @if($r->status == 'pending')
                                            <div class="flex gap-2">
                                                <form action="{{ route('admin.dinkes.referrals.update', $r->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit"
                                                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs font-bold shadow"
                                                        onclick="return confirm('Setujui rujukan ini?')">
                                                        ✓ Terima
                                                    </button>
                                                </form>

                                                <button onclick="openRejectModal('{{ $r->id }}')"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-bold shadow">
                                                    ✕ Tolak
                                                </button>
                                            </div>
                                        @else
                                            <span class="text-gray-400 text-xs italic">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada pengajuan rujukan
                                        hari ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tolak Rujukan --}}
    <div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg leading-6 font-medium text-red-600">Tolak Rujukan</h3>
                <form id="rejectForm" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="rejected">

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Alasan Penolakan</label>
                        <textarea name="feedback_note" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required
                            placeholder="Contoh: RS Tujuan Penuh, Dokumen tidak lengkap..."></textarea>
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeRejectModal()"
                            class="bg-gray-300 hover:bg-gray-400 text-black py-2 px-4 rounded">Batal</button>
                        <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded">Tolak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openRejectModal(id) {
            document.getElementById('rejectModal').classList.remove('hidden');
            let form = document.getElementById('rejectForm');
            form.action = `/admin/referrals/${id}`;
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }
    </script>
</x-app-layout>