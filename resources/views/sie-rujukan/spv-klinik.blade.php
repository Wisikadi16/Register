@extends('sie-rujukan.feature-layout')

@section('title', 'Supervisi Klinik Utama')
@section('subtitle', 'Pemeriksaan Standar Layanan Medis Klinik Utama')
@section('form_action', route('sie.spv.klinik'))

@section('form_content')
    <div class="space-y-4 mb-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Klinik</label>
            <select name="klinik_id" required
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3">
                <option value="">-- Pilih Klinik --</option>
                <option value="Klinik Pratama Sehat">Klinik Pratama Sehat</option>
                <option value="Klinik Utama Kasih Ibu">Klinik Utama Kasih Ibu</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Kategori Evaluasi</label>
            <input type="text" name="kategori" required
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3"
                placeholder="Misal: Perpanjangan Izin, Evaluasi Tahunan">
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Rangkuman Inspeksi</label>
            <textarea name="inspeksi" required rows="4"
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3"
                placeholder="Tuliskan bukti kelayakan operasional klinik utama..."></textarea>
        </div>
    </div>
@endsection

@section('table_headers')
    <th class="py-4 px-4">Klinik Tujuan</th>
    <th class="py-4 px-4">Kategori Evaluasi</th>
@endsection

@section('table_rows')
    @forelse($data as $index => $item)
        <tr class="hover:bg-slate-50/50 transition-colors group">
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500">{{ $index + 1 }}</td>
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500">{{ $item->created_at->format('d M Y') }}</td>

            <td class="py-4 px-4 border-b border-slate-50 text-slate-800 font-bold">{{ $item->klinik_id }}</td>
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500">{{ $item->kategori }}</td>

            <td class="py-4 px-4 border-b border-slate-50 text-center">
                <span
                    class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold border border-emerald-200/50">Diinspeksi</span>
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
            <td colspan="6" class="py-8 text-center text-slate-400">Belum ada data supervisi klinik utama.</td>
        </tr>
    @endforelse
@endsection