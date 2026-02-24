@extends('sie-rujukan.feature-layout')

@section('title', 'Supervisi Rumah Sakit')
@section('subtitle', 'Monitoring Kesiapan Kamar dan Rujukan Rumah Sakit')
@section('form_action', route('sie.spv.rs'))

@section('form_content')
    <div class="space-y-4 mb-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Rumah Sakit</label>
            <select name="rs_id" required
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3">
                <option value="">-- Pilih Rumah Sakit --</option>
                <option value="RSUP Dr. Kariadi">RSUP Dr. Kariadi</option>
                <option value="RSUD Wongsonegoro">RSUD Wongsonegoro</option>
                <option value="RS Panti Wilasa">RS Panti Wilasa</option>
                <option value="RS Telogorejo">RS Telogorejo</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Jenis Supervisi</label>
            <select name="jenis" required
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3">
                <option value="Audit Ketersediaan Bed">Audit Ketersediaan Bed/Kamar IGD</option>
                <option value="Kesiapan Fasilitas Rujukan">Kesiapan Fasilitas Rujukan</option>
                <option value="Kesesuaian Pelayanan Medis">Kesesuaian Pelayanan Medis</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Catatan Kunjungan/Inspeksi</label>
            <textarea name="catatan" required rows="4"
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3"
                placeholder="Hasil kunjungan lapangan..."></textarea>
        </div>
    </div>
@endsection

@section('table_headers')
    <th class="py-4 px-4">Rumah Sakit</th>
    <th class="py-4 px-4">Jenis Kasus</th>
@endsection

@section('table_rows')
    @forelse($data as $index => $item)
        <tr class="hover:bg-slate-50/50 transition-colors group">
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500">{{ $index + 1 }}</td>
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500">{{ $item->created_at->format('d M Y') }}</td>

            <td class="py-4 px-4 border-b border-slate-50 text-slate-800 font-bold">{{ $item->rs_id }}</td>
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500">{{ $item->jenis }}</td>

            <td class="py-4 px-4 border-b border-slate-50 text-center">
                <span
                    class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold border border-emerald-200/50">Selesai</span>
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
            <td colspan="6" class="py-8 text-center text-slate-400">Belum ada data supervisi rumah sakit.</td>
        </tr>
    @endforelse
@endsection