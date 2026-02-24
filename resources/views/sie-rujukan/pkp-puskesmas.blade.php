@extends('sie-rujukan.feature-layout')

@section('title', 'PKP Puskesmas')
@section('subtitle', 'Penilaian Kinerja Puskesmas')
@section('form_action', route('sie.pkp.puskesmas'))

@section('form_content')
    <div class="space-y-4 mb-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Pilih Puskesmas</label>
            <select name="puskesmas_id" required
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3">
                <option value="">-- Pilih Puskesmas --</option>
                <option value="Puskesmas Pandanaran">Puskesmas Pandanaran</option>
                <option value="Puskesmas Halmahera">Puskesmas Halmahera</option>
                <option value="Puskesmas Srondol">Puskesmas Srondol</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Periode Penilaian (Bulan-Tahun)</label>
            <input type="month" name="periode" required
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3">
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Nilai Kinerja (0-100)</label>
            <input type="number" min="0" max="100" name="nilai" required
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3"
                placeholder="Misal: 85">
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Catatan Evaluasi</label>
            <textarea name="catatan" rows="4"
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3"
                placeholder="Tuliskan catatan evaluasi kinerja di sini..."></textarea>
        </div>
    </div>
@endsection

@section('table_headers')
    <th class="py-4 px-4">Puskesmas</th>
    <th class="py-4 px-4 text-center">Periode</th>
    <th class="py-4 px-4 text-center">Nilai</th>
@endsection

@section('table_rows')
    @forelse($data as $index => $item)
        <tr class="hover:bg-slate-50/50 transition-colors group">
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500">{{ $index + 1 }}</td>
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500">{{ $item->created_at->format('d M Y') }}</td>

            <!-- Custom columns -->
            <td class="py-4 px-4 border-b border-slate-50 text-slate-800 font-bold">{{ $item->puskesmas_id }}</td>
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500 text-center">{{ $item->periode }}</td>
            <td class="py-4 px-4 border-b border-slate-50 text-indigo-600 font-black text-center text-lg">{{ $item->nilai }}
            </td>
            <!-- End Custom columns -->

            <td class="py-4 px-4 border-b border-slate-50 text-center">
                <span
                    class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold border border-emerald-200/50">Tersimpan</span>
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
            <td colspan="7" class="py-8 text-center text-slate-400">Belum ada data penilaian kinerja.</td>
        </tr>
    @endforelse
@endsection