@extends('sie-rujukan.feature-layout')

@section('title', 'Laporan BHD')
@section('subtitle', 'Cetak Rekapitulasi Relawan Bantuan Hidup Dasar')
@section('form_action', route('sie.laporan.bhd'))

@section('form_content')
    <div class="space-y-4 mb-6">
        <div class="p-4 rounded-xl bg-indigo-50 border border-indigo-200 text-indigo-800 text-sm mb-4 leading-relaxed">
            <i class="fas fa-info-circle mr-2"></i> Gunakan form ini untuk mencetak dokumen sertifikat/rekap keaktifan
            Peserta Pelatihan Relawan BHD di wilayah kerja Anda.
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Periode Pelatihan BHD</label>
            <select name="periode" required
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3">
                <option value="Kuartal 1 (Jan-Mar) 2026">Kuartal 1 (Jan-Mar) 2026</option>
                <option value="Kuartal 4 (Okt-Des) 2025">Kuartal 4 (Okt-Des) 2025</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Lokasi Penyelenggaraan</label>
            <input type="text" name="lokasi" required
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3"
                placeholder="Contoh: Balai Kota Semarang / CFD Simpang Lima">
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Keterangan Dokumen</label>
            <textarea name="keterangan" rows="3"
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3"
                placeholder="Tujuan penerbitan laporan BHD..."></textarea>
        </div>
    </div>
@endsection

@section('table_headers')
    <th class="py-4 px-4">Batch Pelatihan</th>
    <th class="py-4 px-4">Lokasi Pusat</th>
@endsection

@section('table_rows')
    @forelse($data as $index => $item)
        <tr class="hover:bg-slate-50/50 transition-colors group">
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500">{{ $index + 1 }}</td>
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500">{{ $item->created_at->format('d M Y') }}</td>

            <td class="py-4 px-4 border-b border-slate-50 text-slate-800 font-bold">{{ $item->periode }}</td>
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500">{{ $item->lokasi }}</td>

            <td class="py-4 px-4 border-b border-slate-50 text-center">
                <span
                    class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold border border-emerald-200/50">Tercetak</span>
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
            <td colspan="6" class="py-8 text-center text-slate-400">Belum ada data laporan BHD tercetak.</td>
        </tr>
    @endforelse
@endsection