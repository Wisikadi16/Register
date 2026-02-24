@extends('sie-rujukan.feature-layout')

@section('title', 'Validasi Data LPLPO')
@section('subtitle', 'Laporan Pemakaian dan Lembar Permintaan Obat')
@section('form_action', route('sie.validasi.lplpo'))

@section('form_content')
    <div class="space-y-4 mb-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Instansi Pelapor</label>
            <select name="instansi_id" required
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3">
                <option value="">-- Pilih Instansi --</option>
                <option value="Puskesmas Pandanaran">Puskesmas Pandanaran</option>
                <option value="Puskesmas Halmahera">Puskesmas Halmahera</option>
                <option value="Klinik Pratama Sehat">Klinik Pratama Sehat</option>
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Bulan Pelaporan</label>
                <input type="month" name="bulan" required
                    class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Status Stok Indikator</label>
                <select name="status_stok" required
                    class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3">
                    <option value="Aman (Cukup > 3 Bulan)">Aman (Cukup > 3 Bulan)</option>
                    <option value="Warning (Sisa 1-2 Bulan)">Warning (Sisa 1-2 Bulan)</option>
                    <option value="Kritis (Kosong / Hampir Habis)">Kritis (Kosong / Hampir Habis)</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Evaluasi Persetujuan LPLPO</label>
            <textarea name="evaluasi" rows="4"
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3"
                placeholder="Tulis catatan jika ada permintaan obat yang dikurangi dosisnya atau disetujui penuh..."></textarea>
        </div>

        <div class="mt-4 form-check">
            <input type="checkbox" name="sah" id="sah" class="rounded text-indigo-600 focus:ring-indigo-500">
            <label for="sah" class="ml-2 text-sm text-slate-700 font-bold">Setujui Permintaan Obat Ini</label>
        </div>
    </div>
@endsection

@section('table_headers')
    <th class="py-4 px-4">Faskes Pelapor</th>
    <th class="py-4 px-4 text-center">Bulan LPLPO</th>
@endsection

@section('table_rows')
    @forelse($data as $index => $item)
        <tr class="hover:bg-slate-50/50 transition-colors group">
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500">{{ $index + 1 }}</td>
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500">{{ $item->created_at->format('d M Y') }}</td>

            <td class="py-4 px-4 border-b border-slate-50 text-slate-800 font-bold">{{ $item->instansi_id }}</td>
            <td class="py-4 px-4 border-b border-slate-50 text-center font-bold text-indigo-600">
                {{ \Carbon\Carbon::parse($item->bulan)->locale('id')->isoFormat('MMMM Y') }}</td>

            <td class="py-4 px-4 border-b border-slate-50 text-center">
                @if($item->sah === 'Ya')
                    <span
                        class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold border border-emerald-200/50">Disetujui</span>
                @else
                    <span
                        class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-bold border border-amber-200/50">Pending</span>
                @endif
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
            <td colspan="6" class="py-8 text-center text-slate-400">Belum ada data LPLPO.</td>
        </tr>
    @endforelse
@endsection