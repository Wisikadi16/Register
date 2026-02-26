<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Lab Medik') }}
        </h2>
    </x-slot>

    <!-- Welcome Banner with Brand Colors -->
    <div class="bg-gradient-to-r from-rescue-red to-red-800 pb-12 pt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-black text-white tracking-tight mb-2">
                Halo, {{ Auth::user()->name }}! 👋
            </h1>
            <p class="text-red-100 font-medium">Panel Utama Manajemen Data Pasien Laboratorium</p>
        </div>
    </div>

    <div class="-mt-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Action / Tapping Area -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="{{ route('lab-medik.patients.create') }}"
                class="group block relative p-6 bg-white rounded-2xl shadow-sm border border-slate-200 hover:border-blue-300 hover:shadow-md transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                <div
                    class="absolute -right-4 -top-4 w-24 h-24 bg-blue-50 rounded-full group-hover:bg-blue-100 transition-colors duration-300 -z-0">
                </div>
                <div class="flex items-start gap-4 relative z-10">
                    <div
                        class="w-12 h-12 rounded-xl bg-blue-600 text-white flex items-center justify-center text-xl font-bold shadow-sm">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-charcoal mb-1">Input Data Pasien</h3>
                        <p class="text-sm text-slate-500 font-medium">Tambahkan data pasien baru beserta hasil tes
                            laboratoriumnya.</p>
                    </div>
                </div>
            </a>

            <a href="#"
                class="group block relative p-6 bg-white rounded-2xl shadow-sm border border-slate-200 hover:border-amber-300 hover:shadow-md transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                <div
                    class="absolute -right-4 -top-4 w-24 h-24 bg-amber-50 rounded-full group-hover:bg-amber-100 transition-colors duration-300 -z-0">
                </div>
                <div class="flex items-start gap-4 relative z-10">
                    <div
                        class="w-12 h-12 rounded-xl bg-amber-500 text-white flex items-center justify-center text-xl font-bold shadow-sm">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-charcoal mb-1">Pengajuan & Komplain</h3>
                        <p class="text-sm text-slate-500 font-medium">Ajukan permintaan logistik, maintenance alat lab,
                            atau komplain sistem.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Patients Data Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
                <h3 class="font-black text-lg text-charcoal">Riwayat Input Data Pasien</h3>
                <span
                    class="text-xs font-bold bg-blue-100 text-blue-700 px-3 py-1 rounded-full uppercase">{{ $patients->count() }}
                    Pasien Terdata</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-800 text-white sticky top-0 z-10 shadow-md">
                        <tr>
                            <th class="p-4 text-sm font-bold">Waktu Input</th>
                            <th class="p-4 text-sm font-bold">Data Pasien</th>
                            <th class="p-4 text-sm font-bold">Jenis Pemeriksaan</th>
                            <th class="p-4 text-sm font-bold">Hasil Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($patients as $patient)
                            <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                                <td class="p-4 align-top">
                                    <p class="font-bold text-charcoal">{{ $patient->created_at->format('d M Y') }}</p>
                                    <p class="text-xs text-slate-500">{{ $patient->created_at->format('H:i') }} WIB</p>
                                </td>
                                <td class="p-4 max-w-sm align-top">
                                    <p class="font-bold text-charcoal text-base">{{ $patient->name }} <span
                                            class="text-xs font-normal text-slate-500 bg-slate-200 px-2 py-0.5 rounded-full ml-1">{{ $patient->gender == 'Laki-laki' ? 'L' : 'P' }}
                                            / {{ $patient->age }}thn</span></p>
                                    @if($patient->nik)
                                        <p class="text-xs font-medium text-slate-500 mt-1"><i
                                                class="fas fa-id-card mr-1 text-slate-400"></i> NIK: {{ $patient->nik }}</p>
                                    @endif
                                    @if($patient->address)
                                        <p class="text-xs text-slate-500 mt-1 leading-relaxed"><i
                                                class="fas fa-map-marker-alt mr-1 text-slate-400"></i> {{ $patient->address }}
                                        </p>
                                    @endif
                                </td>
                                <td class="p-4 align-top">
                                    <span
                                        class="px-3 py-1 text-xs font-bold rounded-full border border-blue-200 bg-blue-50 text-blue-700 capitalize">
                                        <i class="fas fa-vial mr-1"></i> {{ $patient->test_type }}
                                    </span>
                                </td>
                                <td class="p-4 align-top">
                                    @if($patient->result)
                                        <p
                                            class="text-sm font-bold text-charcoal bg-slate-100 px-3 py-2 rounded-lg leading-relaxed">
                                            {{ $patient->result }}</p>
                                    @else
                                        <span
                                            class="text-xs font-bold text-amber-600 bg-amber-50 px-3 py-1 rounded-lg border border-amber-200">
                                            <i class="fas fa-clock mr-1"></i> Menunggu Hasil
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-12 text-center text-slate-400 bg-slate-50/50">
                                    <div
                                        class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm border border-slate-100">
                                        <i class="fas fa-notes-medical text-4xl text-slate-300"></i>
                                    </div>
                                    <h3 class="font-bold text-lg text-slate-600 mb-1">Belum Ada Data</h3>
                                    <p class="text-sm">Anda belum menginput data pasien lab jenis apa pun.</p>
                                    <a href="{{ route('lab-medik.patients.create') }}"
                                        class="inline-block mt-4 text-sm font-bold text-blue-600 hover:text-blue-800">
                                        + Input Data Pertama Anda
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="h-10"></div>
    </div>
</x-app-layout>