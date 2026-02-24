@extends('sie-rujukan.feature-layout')

@section('title', 'Validasi Jadwal Petugas')
@section('subtitle', 'Persetujuan Jadwal Jaga Shift Operasional (SPGDT / Faskes)')
@section('form_action', route('sie.validasi.jadwal'))

@section('form_content')
    <div class="space-y-4 mb-6">
        <div class="p-4 rounded-xl bg-orange-50 border border-orange-200 text-orange-800 text-sm mb-4">
            <i class="fas fa-info-circle mr-2"></i> Pilih kelompok tugas bulanan yang akan divalidasi dan disahkan.
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Modul Jadwal</label>
            <select name="modul" required
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3">
                <option value="Shift Operator (112 Command Center)">Shift Operator (112 Command Center)</option>
                <option value="Shift Sopir & Nakes Ambulan Hebat">Shift Sopir & Nakes Ambulan Hebat</option>
                <option value="Shift Jaga IGD / Faskes Mitra">Shift Jaga IGD / Faskes Mitra</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Bulan & Tahun</label>
            <input type="month" name="bulan_tahun" required
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3">
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Catatan Validasi</label>
            <textarea name="catatan" rows="3"
                class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-3"
                placeholder="Sebutkan jika ada jadwal yang harus revisi atau disahkan..."></textarea>
        </div>

        <div class="mt-4 form-check">
            <input type="checkbox" name="sah" id="sah" class="rounded text-indigo-600 focus:ring-indigo-500">
            <label for="sah" class="ml-2 text-sm text-slate-700 font-bold">Tandai Jadwal ini sebagai SAH & Bisa
                Diterbitkan</label>
        </div>
    </div>
@endsection

@section('table_headers')
    <th class="py-4 px-4">Kategori Unit Tugas</th>
    <th class="py-4 px-4 text-center">Bulan Berlaku</th>
@endsection

@section('table_rows')
    @forelse($data as $index => $item)
        <tr class="hover:bg-slate-50/50 transition-colors group">
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500">{{ $index + 1 }}</td>
            <td class="py-4 px-4 border-b border-slate-50 text-slate-500">{{ $item->created_at->format('d M Y') }}</td>

            <td class="py-4 px-4 border-b border-slate-50 text-slate-800 font-bold">{{ $item->modul }}</td>
            <td class="py-4 px-4 border-b border-slate-50 text-amber-600 text-center font-bold">
                {{ \Carbon\Carbon::parse($item->bulan_tahun)->locale('id')->isoFormat('MMMM Y') }}</td>

            <td class="py-4 px-4 border-b border-slate-50 text-center">
                @if($item->sah === 'Ya')
                    <span
                        class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold border border-emerald-200/50">Sah</span>
                @else
                    <span
                        class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-bold border border-amber-200/50">Belum
                        Sah</span>
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
            <td colspan="6" class="py-8 text-center text-slate-400">Belum ada data validasi jadwal.</td>
        </tr>
    @endforelse
@endsection