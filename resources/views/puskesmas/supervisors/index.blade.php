<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <a href="{{ route('puskesmas.dashboard') }}"
                        class="inline-flex items-center text-slate-400 hover:text-blue-600 font-bold text-sm mb-2 transition">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
                    </a>
                    <h2 class="text-3xl font-black text-slate-800 tracking-tight">Data Supervisor</h2>
                    <p class="text-slate-500">Kelola informasi personil supervisor puskesmas.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Card Form Input -->
                <div
                    class="bg-white rounded-[2rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-100 h-fit sticky top-6">
                    <div class="flex items-center gap-4 mb-6">
                        <div
                            class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl shadow-sm">
                            <i class="fas fa-plus"></i>
                        </div>
                        <h3 class="font-bold text-xl text-slate-800">Tambah Data</h3>
                    </div>

                    <form action="{{ route('puskesmas.supervisors.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" placeholder="Contoh: Dr. Budi Santoso"
                                class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition py-3 px-4 placeholder:text-slate-300"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">NIP <span
                                    class="text-slate-300 font-normal">(Opsional)</span></label>
                            <input type="text" name="nip" placeholder="1980xxxx..."
                                class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition py-3 px-4 placeholder:text-slate-300">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">Jabatan</label>
                            <div class="relative">
                                <span class="absolute left-4 top-3 text-slate-400"><i
                                        class="fas fa-briefcase"></i></span>
                                <input type="text" name="jabatan" placeholder="Kepala Lab / SPV..."
                                    class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition py-3 pl-10 pr-4 placeholder:text-slate-300"
                                    required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">No. Telepon</label>
                            <div class="relative">
                                <span class="absolute left-4 top-3 text-slate-400"><i class="fas fa-phone"></i></span>
                                <input type="text" name="phone" placeholder="081xxx..."
                                    class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition py-3 pl-10 pr-4 placeholder:text-slate-300">
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-500/30 transition transform hover:scale-[1.02] active:scale-95">
                            <i class="fas fa-save mr-2"></i> Simpan Supervisor
                        </button>
                    </form>
                </div>

                <!-- List Data Table -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                        <div class="p-6 border-b border-slate-50 bg-slate-50/50 flex justify-between items-center">
                            <h3 class="font-bold text-lg text-slate-700">Daftar Supervisor Aktif</h3>
                            <span
                                class="bg-blue-100 text-blue-700 py-1 px-3 rounded-full text-xs font-bold">{{ count($supervisors) }}
                                Orang</span>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead
                                    class="bg-white text-slate-400 text-xs uppercase font-bold tracking-wider border-b border-slate-100">
                                    <tr>
                                        <th class="px-6 py-5">Personil</th>
                                        <th class="px-6 py-5">Jabatan Detail</th>
                                        <th class="px-6 py-5 text-right">Kontak</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @forelse($supervisors as $spv)
                                        <tr class="hover:bg-blue-50/30 transition duration-200 group">
                                            <td class="px-6 py-5">
                                                <div class="flex items-center gap-4">
                                                    <div
                                                        class="w-12 h-12 rounded-full bg-gradient-to-br from-slate-100 to-slate-200 text-slate-500 flex items-center justify-center font-bold text-lg border-2 border-white shadow-sm group-hover:from-blue-100 group-hover:to-blue-50 group-hover:text-blue-600 transition">
                                                        {{ substr($spv->name, 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <div
                                                            class="font-bold text-slate-800 text-base group-hover:text-blue-700 transition">
                                                            {{ $spv->name }}</div>
                                                        <div class="text-xs text-slate-400 font-mono mt-0.5">NIP:
                                                            {{ $spv->nip ?? '-' }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5">
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-slate-100 text-slate-600 group-hover:bg-white group-hover:shadow-sm group-hover:text-blue-600 transition border border-transparent group-hover:border-slate-100">
                                                    {{ $spv->jabatan }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-5 text-right">
                                                @if($spv->phone)
                                                    <a href="https://wa.me/{{ $spv->phone }}" target="_blank"
                                                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-green-50 text-green-600 hover:bg-green-500 hover:text-white transition shadow-sm hover:shadow-green-500/30">
                                                        <i class="fab fa-whatsapp text-lg"></i>
                                                    </a>
                                                @else
                                                    <span class="text-slate-300 text-xs italic">No Phone</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-6 py-12 text-center text-slate-400">
                                                <div
                                                    class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3">
                                                    <i class="fas fa-users-slash text-2xl text-slate-300"></i>
                                                </div>
                                                <p>Belum ada data supervisor.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>