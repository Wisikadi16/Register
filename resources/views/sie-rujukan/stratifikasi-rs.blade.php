@extends('sie-rujukan.feature-layout')

@section('title', 'Stratifikasi RS')
@section('subtitle', 'Pemetaan & Peningkatan Level Layanan Rumah Sakit')
@section('form_action', route('sie.stratifikasi.rs'))

@section('form_content')
    <div class="space-y-4 mb-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Pilih Rumah Sakit</label>
            <select name="rs_id" required
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3">
                <option value="">-- Pilih Rumah Sakit --</option>
                <option value="RSUD Wongsonegoro">RSUD Wongsonegoro</option>
                <option value="RS Telogorejo">RS Telogorejo</option>
                <option value="RS Panti Wilasa">RS Panti Wilasa</option>
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Tipe Lama</label>
                <input type="text" name="tipe_lama" value="Tipe C"
                    class="w-full rounded-xl border-slate-200 bg-gray-100 text-gray-500 py-3" readonly>
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Usulan Tipe Baru</label>
                <select name="tipe_baru" required
                    class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3">
                    <option value="Tipe A">Tipe A</option>
                    <option value="Tipe B">Tipe B</option>
                    <option value="Tipe C">Tipe C</option>
                    <option value="Tipe D">Tipe D</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Analisis Pemenuhan Syarat Stratifikasi</label>
            <textarea name="analisis" required rows="4"
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3"
                placeholder="Sebutkan sarana dan prasarana apa saja yang mendorong kelayakan naik/turun tipe RS..."></textarea>
        </div>
    </div>
@endsection

@section('table_headers')
    <th class="py-4 px-4">Rumah Sakit</th>
    <th class="py-4 px-4 text-center">Tipe Awal -> Baru</th>
@endsection

@section('table_rows')
    @forelse($data as $index => $item)
        <tr class="hover:bg-slate-50/50 transition-colors group">
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500">{{ $index + 1 }}</td>
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500">{{ $item->created_at->format('d M Y') }}</td>

            <td class="py-4 px-4 border-b border-slate-50 text-slate-800 font-bold">{{ $item->rs_id }}</td>
            <td class="py-4 px-4 border-b border-slate-50 text-center">
                <span class="text-slate-400 line-through">{{ $item->tipe_lama }}</span>
                <i class="fas fa-arrow-right mx-2 text-indigo-400"></i>
                <span class="text-indigo-600 font-bold">{{ $item->tipe_baru }}</span>
            </td>

            <td class="py-4 px-4 border-b border-slate-50 text-center">
                <span
                    class="px-3 py-1 bg-cyan-100 text-cyan-700 rounded-full text-xs font-bold border border-cyan-200/50">Diarsipkan</span>
            </td>
            <td class="py-4 px-4 border-b border-slate-50 text-center">
                <button
                    class="w-8 h-8 rounded-lg bg-slate-50 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 transition-colors flex items-center justify-center mx-auto">
                    <i class="fas fa-eye text-xs"></i>
                </button>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="py-8 text-center text-slate-400">Belum ada data stratifikasi RS.</td>
        </tr>
    @endforelse
@endsection