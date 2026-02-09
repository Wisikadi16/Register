<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            🚑 Dashboard Operator Command Center
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Welcome Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-600">
                <h3 class="font-bold text-lg text-gray-900">Halo, {{ Auth::user()->name }}!</h3>
                <p class="text-gray-600">Pantau panggilan masuk, kelola penugasan, dan rujukan armada ambulan dari sini.
                </p>
            </div>

            <!-- Emergency Calls List -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="font-bold text-lg mb-4 text-red-600 flex items-center gap-2">
                        🚨 Panggilan Darurat Masuk
                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">{{ $emergencies->count() }}
                            Total</span>
                    </h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 uppercase tracking-wider text-xs font-bold text-gray-500">
                                <tr>
                                    <th class="px-6 py-4 text-left">Waktu</th>
                                    <th class="px-6 py-4 text-left">Pelapor</th>
                                    <th class="px-6 py-4 text-left">Lokasi/Kejadian</th>
                                    <th class="px-6 py-4 text-center">Status</th>
                                    <th class="px-6 py-4 text-center">Armada & Tujuan</th>
                                    <th class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                @forelse($emergencies as $emergency)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-gray-500">
                                            {{ $emergency->created_at->format('d/m/Y H:i') }}<br>
                                            <span
                                                class="text-xs text-gray-400">{{ $emergency->created_at->diffForHumans() }}</span>
                                        </td>
                                        <td class="px-6 py-4 font-bold">{{ $emergency->user->name ?? 'Anonim' }}</td>
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-gray-900 truncate w-48"
                                                title="{{ $emergency->description }}">
                                                {{ $emergency->description }}
                                            </div>
                                            <div class="text-xs text-blue-600 mt-1 cursor-pointer hover:underline"
                                                onclick="window.open('https://www.google.com/maps?q={{ $emergency->latitude }},{{ $emergency->longitude }}', '_blank')">
                                                📍 Lihat Peta
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-2 py-1 text-xs rounded-full font-bold uppercase
                                                    @if($emergency->status == 'pending') bg-red-500 text-white animate-pulse
                                                    @elseif($emergency->status == 'process') bg-yellow-400 text-yellow-900
                                                    @elseif($emergency->status == 'cancelled') bg-gray-500 text-white
                                                    @else bg-green-500 text-white @endif">
                                                {{ $emergency->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @if($emergency->ambulance)
                                                <div class="font-bold text-blue-800">{{ $emergency->ambulance->name }}</div>
                                                <div class="text-xs text-gray-500 mb-1">{{ $emergency->ambulance->plat_number }}
                                                </div>
                                            @else
                                                <div class="text-gray-400 italic font-bold">- Belum Ada -</div>
                                            @endif

                                            @if($emergency->hospital)
                                                <div class="mt-1 pt-1 border-t border-gray-200">
                                                    <div class="text-xs text-gray-500">Tujuan:</div>
                                                    <div class="font-bold text-green-700 text-xs">
                                                        {{ $emergency->hospital->name }}</div>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @if($emergency->status == 'pending' || $emergency->status == 'process')
                                                <div class="flex flex-col gap-1">
                                                    <!-- Assign/Re-assign -->
                                                    <button
                                                        onclick="openAssignModal({{ $emergency->id }}, '{{ $emergency->ambulance_id }}')"
                                                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-xs shadow transition">
                                                        🚑 Penugasan
                                                    </button>

                                                    <!-- Set Destination (Hanya jika process) -->
                                                    @if($emergency->status == 'process')
                                                        <button onclick="openDestinationModal({{ $emergency->id }})"
                                                            class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-xs shadow transition">
                                                            🏥 Set Tujuan
                                                        </button>
                                                    @endif

                                                    <!-- Cancel -->
                                                    <button onclick="openCancelModal({{ $emergency->id }})"
                                                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-3 rounded text-xs shadow transition">
                                                        ❌ Batalkan
                                                    </button>
                                                </div>
                                            @elseif($emergency->status == 'completed')
                                                <span class="text-green-600 font-bold text-xs">✓ Selesai</span>
                                            @elseif($emergency->status == 'cancelled')
                                                <span class="text-gray-500 font-bold text-xs">✕ Dibatalkan</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-8 text-center text-gray-500 italic">
                                            Belum ada panggilan darurat.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Penugasan Manual -->
    <div id="assignModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 class="text-lg leading-6 font-medium text-gray-900 text-center">Pilih Armada Ambulan</h3>
            <div class="mt-2 text-center">
                <form id="assignForm" method="POST" action="">
                    @csrf
                    <div class="mb-4 text-left">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Ambulan Ready:</label>
                        <select name="ambulance_id" id="ambulanceSelect" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="" disabled selected>-- Pilih Ambulan --</option>
                            @foreach($ambulances as $amb)
                                <option value="{{ $amb->id }}"
                                    class="{{ $amb->status == 'busy' ? 'text-gray-400 bg-gray-100' : 'text-green-700 font-bold' }}"
                                    {{ $amb->status == 'busy' ? 'disabled' : '' }}>
                                    {{ $amb->name }} ({{ strtoupper($amb->status) }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-center gap-2 mt-4">
                        <button type="button" onclick="document.getElementById('assignModal').classList.add('hidden')"
                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Set Destination -->
    <div id="destinationModal"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 class="text-lg leading-6 font-medium text-gray-900 text-center">Set Rumah Sakit Tujuan</h3>
            <div class="mt-2 text-center">
                <p class="text-sm text-gray-500 mb-4">Pilih RS rujukan berdasarkan ketersediaan Bed IGD.</p>
                <form id="destinationForm" method="POST" action="">
                    @csrf
                    <div class="mb-4 text-left">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Rumah Sakit:</label>
                        <select name="hospital_id" id="hospitalSelect" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                            <option value="" disabled selected>-- Pilih RS Tujuan --</option>
                            @foreach($hospitals as $rs)
                                <option value="{{ $rs->id }}">
                                    {{ $rs->name }} (Bed IGD: {{ $rs->available_bed_igd }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-center gap-2 mt-4">
                        <button type="button"
                            onclick="document.getElementById('destinationModal').classList.add('hidden')"
                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Tetapkan
                            Tujuan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Cancel -->
    <div id="cancelModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 class="text-lg leading-6 font-medium text-red-600 text-center">Batalkan Panggilan?</h3>
            <div class="mt-2 text-center">
                <p class="text-sm text-gray-500 mb-4">
                    Tindakan ini akan membatalkan panggilan dan membebaskan ambulan yang bertugas.
                </p>
                <form id="cancelForm" method="POST" action="">
                    @csrf
                    <div class="mb-4 text-left">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Alasan Pembatalan:</label>
                        <textarea name="cancellation_note" rows="3" required
                            placeholder="Contoh: Prank, Salah Sambung, Sudah dibawa kendaraan sendiri..."
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"></textarea>
                    </div>
                    <div class="flex justify-center gap-2 mt-4">
                        <button type="button" onclick="document.getElementById('cancelModal').classList.add('hidden')"
                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Kembali</button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Batalkan
                            Panggilan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openAssignModal(id) {
            document.getElementById('assignForm').action = `/operator/emergency/${id}/assign`;
            document.getElementById('ambulanceSelect').value = "";
            document.getElementById('assignModal').classList.remove('hidden');
        }

        function openDestinationModal(id) {
            document.getElementById('destinationForm').action = `/operator/emergency/${id}/set-destination`;
            document.getElementById('hospitalSelect').value = "";
            document.getElementById('destinationModal').classList.remove('hidden');
        }

        function openCancelModal(id) {
            document.getElementById('cancelForm').action = `/operator/emergency/${id}/cancel`;
            document.getElementById('cancelModal').classList.remove('hidden');
        }

        // Close logic for clicking outside modals
        window.onclick = function (event) {
            if (event.target.classList.contains('fixed')) {
                event.target.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>