@extends('sie-rujukan.feature-layout')

@section('title', 'Supervisi Puskesmas')
@section('subtitle', 'Monitoring Fasilitas dan Pelayanan Puskesmas')
@section('form_action', route('sie.spv.puskesmas'))

@section('form_content')
    <div class="space-y-4 mb-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Sasaran Supervisi (Puskesmas)</label>
            <select name="puskesmas_id" required
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3">
                <option value="">-- Pilih Puskesmas --</option>
                <option value="Puskesmas Pandanaran">Puskesmas Pandanaran</option>
                <option value="Puskesmas Halmahera">Puskesmas Halmahera</option>
                <option value="Puskesmas Srondol">Puskesmas Srondol</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Aspek Penilaian</label>
            <select name="aspek" required
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3">
                <option value="Pelayanan Medis">Pelayanan Medis Dasar</option>
                <option value="Fasilitas & SDM">Fasilitas dan SDM</option>
                <option value="Manajemen & Administrasi">Manajemen & Administrasi</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Hasil Temuan</label>
            <textarea name="temuan" required rows="3"
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3"
                placeholder="Uraikan temuan di lapangan..."></textarea>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Rekomendasi Tindak Lanjut</label>
            <textarea name="rekomendasi" rows="3"
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3"
                placeholder="Saran perbaikan untuk instansi terkait..."></textarea>
        </div>
    </div>
@endsection

@section('table_headers')
    <th class="py-4 px-4">Instansi</th>
    <th class="py-4 px-4">Aspek Supervisi</th>
@endsection

@section('table_rows')
    @forelse($data as $index => $item)
        <tr class="hover:bg-slate-50/50 transition-colors group">
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500">{{ $index + 1 }}</td>
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500">{{ $item->created_at->format('d M Y') }}</td>

            <td class="py-4 px-4 border-b border-slate-50 text-slate-800 font-bold">{{ $item->puskesmas_id }}</td>
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500">{{ $item->aspek }}</td>

            <td class="py-4 px-4 border-b border-slate-50 text-center">
                <span
                    class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold border border-emerald-200/50">Disupervisi</span>
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
            <td colspan="6" class="py-8 text-center text-slate-400">Belum ada data supervisi puskesmas.</td>
        </tr>
    @endforelse
@endsection