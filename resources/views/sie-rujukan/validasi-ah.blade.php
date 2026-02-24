@extends('sie-rujukan.feature-layout')

@section('title', 'Validasi Data AH')
@section('subtitle', 'Validasi Kasus Kegawatdaruratan Medis Ambulan Hebat')
@section('form_action', route('sie.validasi.ah'))

@section('form_content')
    <div class="space-y-4 mb-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Nomor Tiket / Panggilan Darurat</label>
            <input type="text" name="tiket" required
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3 font-mono"
                placeholder="Contoh: AH-2602-00512">
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Kesesuaian Triage (Penanganan Awal)</label>
            <select name="triage" required
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3">
                <option value="Sesuai SOP">Sesuai SOP</option>
                <option value="Kurang Tepat (Butuh Evaluasi Tim Medis)">Kurang Tepat (Butuh Evaluasi Tim Medis)</option>
                <option value="Pelanggaran Prosedur (Fatal)">Pelanggaran Prosedur (Fatal)</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Evaluasi Penanganan Nakes & Driver</label>
            <textarea name="evaluasi" rows="4"
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3"
                placeholder="Berikan catatan evaluasi dari log penanganan pasien darurat ini..."></textarea>
        </div>

        <div class="mt-4 form-check">
            <input type="checkbox" name="valid" id="valid" class="rounded text-indigo-600 focus:ring-indigo-500">
            <label for="valid" class="ml-2 text-sm text-slate-700 font-bold">Tandai Kasus ini VALID (Sesuai
                Prosedur)</label>
        </div>
    </div>
@endsection

@section('table_headers')
    <th class="py-4 px-4">No. Tiket Panggilan</th>
    <th class="py-4 px-4 text-center">Evaluasi Triage</th>
@endsection

@section('table_rows')
    @forelse($data as $index => $item)
        <tr class="hover:bg-slate-50/50 transition-colors group">
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500">{{ $index + 1 }}</td>
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500">{{ $item->created_at->format('d M Y') }}</td>

            <td class="py-4 px-4 border-b border-slate-50 font-mono text-slate-800 font-bold">{{ $item->tiket }}</td>
            <td
                class="py-4 px-4 border-b border-slate-50 text-center font-bold {{ $item->triage == 'Sesuai SOP' ? 'text-emerald-600' : 'text-red-500' }}">
                {{ $item->triage }}</td>

            <td class="py-4 px-4 border-b border-slate-50 text-center">
                @if($item->valid === 'Ya')
                    <span
                        class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold border border-emerald-200/50">Valid</span>
                @else
                    <span
                        class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-bold border border-amber-200/50">Belum
                        Valid</span>
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
            <td colspan="6" class="py-8 text-center text-slate-400">Belum ada data validasi AH.</td>
        </tr>
    @endforelse
@endsection