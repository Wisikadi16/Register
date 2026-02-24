<x-app-layout>
    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <div class="flex items-center gap-4">
            @php
                $backRoute = 'dashboard';
                if (Auth::user()->role === 'puskesmas') {
                    $backRoute = 'puskesmas.dashboard';
                } elseif (in_array(Auth::user()->role, ['rumahsakit', 'klinik_utama', 'lab_medik'])) {
                    $backRoute = 'faskes.dashboard';
                }
            @endphp
            <a href="{{ url()->previous() == url()->current() ? route($backRoute) : url()->previous() }}"
                class="w-10 h-10 bg-white border border-slate-200 rounded-full flex items-center justify-center text-slate-500 hover:bg-slate-50 hover:text-charcoal transition-colors shadow-sm">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="text-2xl font-black text-charcoal">Pengajuan Logistik & Lapor Kerusakan</h2>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <h3 class="font-bold mb-4">Buat Tiket Baru</h3>
            <form action="{{ route('faskes.requests.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Kategori Laporan</label>
                        <select name="category" required class="w-full rounded-xl border-slate-300">
                            <option value="">Pilih Kategori...</option>
                            <option value="Logistik/Alat Medis">Request Logistik / Alat Medis</option>
                            <option value="Maintenance/Alat Rusak">Lapor Alat Rusak / Maintenance</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Foto Bukti (Opsional)</label>
                        <input type="file" name="photo_proof" class="w-full rounded-xl border border-slate-300 p-2">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-bold text-slate-700 mb-1">Detail Kebutuhan / Kerusakan</label>
                    <textarea name="description" rows="3" required class="w-full rounded-xl border-slate-300"
                        placeholder="Sebutkan nama barang, jumlah, atau keluhannya..."></textarea>
                </div>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-xl transition">
                    Kirim Laporan
                </button>
            </form>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <h3 class="font-bold mb-4">Riwayat Tiket Anda</h3>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="p-3 text-sm font-bold text-slate-600">Tanggal</th>
                        <th class="p-3 text-sm font-bold text-slate-600">Kategori & Detail</th>
                        <th class="p-3 text-sm font-bold text-slate-600">Status</th>
                        <th class="p-3 text-sm font-bold text-slate-600">Balasan Pusat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $req)
                        <tr class="border-b border-slate-100 hover:bg-slate-50">
                            <td class="p-3 text-sm text-slate-500">{{ $req->created_at->format('d M Y') }}</td>
                            <td class="p-3">
                                <span class="text-xs font-bold text-blue-600">{{ $req->category }}</span>
                                <p class="text-sm font-medium text-charcoal">{{ $req->description }}</p>
                            </td>
                            <td class="p-3">
                                <span class="px-3 py-1 text-xs font-bold rounded-full uppercase
                                        {{ $req->status == 'pending' ? 'bg-amber-100 text-amber-700' : '' }}
                                        {{ $req->status == 'process' ? 'bg-blue-100 text-blue-700' : '' }}
                                        {{ $req->status == 'completed' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $req->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                                    {{ $req->status }}
                                </span>
                            </td>
                            <td class="p-3 text-sm text-slate-600 italic">
                                {{ $req->operator_notes ?? 'Belum ada balasan.' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>