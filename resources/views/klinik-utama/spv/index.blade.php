<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            {{-- Bagian Kiri: Tombol Back & Judul --}}
            <div class="flex items-center gap-4">
                <a href="{{ route('klinik.dashboard') }}"
                    class="bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-xl px-4 py-2 font-bold shadow-sm transition flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <h2 class="text-3xl font-black text-gray-800 leading-tight border-l-2 border-gray-200 pl-4">
                    <span class="text-blue-600">Data SPV</span> Klinik Utama
                </h2>
            </div>

            {{-- Bagian Kanan: Breadcrumbs --}}
            <div class="text-sm font-medium text-gray-500 hidden md:block">
                <a href="{{ route('klinik.dashboard') }}" class="text-blue-600 hover:underline">Dashboard</a> <span
                    class="mx-2">/</span> Data SPV
            </div>
        </div>
    </x-slot>


    <div class="py-12 min-h-screen bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            @if(session('success'))
                <div
                    class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-2xl shadow-sm flex items-start gap-4 mb-6">
                    <div class="flex-shrink-0 bg-emerald-100 rounded-full p-2 text-emerald-600">
                        <i class="fas fa-check-circle text-xl"></i>
                    </div>
                    <div>
                        <p class="font-bold text-lg">Berhasil!</p>
                        <p class="text-emerald-700/80">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Form Input Data SPV --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden sticky top-8">
                        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                            <h3 class="font-bold text-lg text-slate-800 flex items-center gap-2">
                                <i class="fas fa-user-plus text-blue-500"></i> Tambah / Inspeksi SPV
                            </h3>
                        </div>
                        <div class="p-6">
                            <form action="{{ route('klinik.spv.store') }}" method="POST">
                                @csrf
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">Kategori /
                                            Jabatan</label>
                                        <input type="text" name="kategori" required
                                            placeholder="Contoh: Supervisor Medis"
                                            class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">Hasil Inspeksi /
                                            Keterangan</label>
                                        <textarea name="inspeksi" rows="4" required
                                            placeholder="Tuliskan keterangan inspeksi atau data terkait..."
                                            class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500"></textarea>
                                    </div>
                                    <button type="submit"
                                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl transition shadow-sm flex items-center justify-center gap-2">
                                        <i class="fas fa-save"></i> Simpan Data SPV
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Tabel Data SPV --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                        <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                            <h3 class="font-bold text-lg text-slate-800 flex items-center gap-2">
                                <i class="fas fa-clipboard-list text-slate-400"></i> Daftar Inspeksi SPV
                            </h3>
                            <span
                                class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-xs font-bold">{{ isset($spvs) ? $spvs->count() : 0 }}
                                Data</span>
                        </div>
                        <div class="p-6">
                            @if(!isset($spvs) || $spvs->isEmpty())
                                <div class="text-center py-12">
                                    <div
                                        class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                                        <i class="fas fa-folder-open text-3xl"></i>
                                    </div>
                                    <h4 class="text-lg font-bold text-slate-700 mb-1">Belum Ada Data</h4>
                                    <p class="text-slate-500 text-sm">Silakan input data supervisor pada form di samping.
                                    </p>
                                </div>
                            @else
                                <div class="overflow-x-auto">
                                    <table class="w-full text-left border-collapse">
                                        <thead>
                                            <tr
                                                class="text-xs font-bold text-slate-400 uppercase tracking-wider border-b border-slate-200">
                                                <th class="px-4 py-3 pb-4">No</th>
                                                <th class="px-4 py-3 pb-4">Kategori / Jabatan</th>
                                                <th class="px-4 py-3 pb-4">Inspeksi / Keterangan</th>
                                                <th class="px-4 py-3 pb-4">Tgl Input</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-slate-600 text-sm">
                                            @foreach($spvs as $index => $spv)
                                                <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition">
                                                    <td class="px-4 py-4">{{ $index + 1 }}</td>
                                                    <td class="px-4 py-4 font-bold text-slate-800">{{ $spv->kategori }}</td>
                                                    <td class="px-4 py-4 text-slate-500 break-words max-w-xs">
                                                        {{ $spv->inspeksi }}
                                                    </td>
                                                    <td class="px-4 py-4 whitespace-nowrap"><span
                                                            class="bg-slate-100 text-slate-600 px-2 py-1 rounded text-xs">{{ $spv->created_at->format('d/m/Y H:i') }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>