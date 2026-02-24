@extends('sie-rujukan.feature-layout')

@section('title', 'Supervisi Laboratorium')
@section('subtitle', 'Monitoring Kelayakan & Fasilitas Laboratorium Medik')
@section('form_action', route('sie.spv.lab'))

@section('form_content')
    <div class="space-y-4 mb-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Pilih Laboratorium</label>
            <select name="lab_id" required
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3">
                <option value="">-- Pilih Laboratorium --</option>
                <option value="Lab Kesehatan Daerah (Labkesda)">Lab Kesehatan Daerah (Labkesda)</option>
                <option value="Lab CITO">Lab CITO</option>
                <option value="Lab Prodia">Lab Prodia</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Target Supervisi</label>
            <select name="target" required
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3">
                <option value="Kelayakan & Kalibrasi Alat Cek">Kelayakan & Kalibrasi Alat Cek</option>
                <option value="Ketersediaan Reagen & Stok">Ketersediaan Reagen & Stok</option>
                <option value="Standar Operasional Prosedur Layanan">Standar Operasional Prosedur Layanan</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Catatan Kelayakan</label>
            <textarea name="catatan" required rows="4"
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3"
                placeholder="Tuliskan temuan kelayakan alat dan ruang lab di sini..."></textarea>
        </div>
    </div>
@endsection

@section('table_headers')
    <th class="py-4 px-4">Laboratorium</th>
    <th class="py-4 px-4">Target Supervisi</th>
@endsection

@section('table_rows')
    @forelse($data as $index => $item)
        <tr class="hover:bg-slate-50/50 transition-colors group">
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500">{{ $index + 1 }}</td>
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500">{{ $item->created_at->format('d M Y') }}</td>

            <td class="py-4 px-4 border-b border-slate-50 text-slate-800 font-bold">{{ $item->lab_id }}</td>
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500">{{ $item->target }}</td>

            <td class="py-4 px-4 border-b border-slate-50 text-center">
                <span
                    class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold border border-emerald-200/50">Diperiksa</span>
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
            <td colspan="6" class="py-8 text-center text-slate-400">Belum ada data supervisi lab.</td>
        </tr>
    @endforelse
@endsection