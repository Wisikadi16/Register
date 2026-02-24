<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- PAGE HEADER -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                <div class="flex items-center gap-4">
                    <a href="{{ route('sie.dashboard') }}"
                        class="w-10 h-10 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-indigo-600 hover:border-indigo-200 hover:bg-indigo-50 transition-all">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <div>
                        <h2 class="text-2xl font-black text-gray-800">
                            @yield('title')
                        </h2>
                        <p class="text-gray-500 text-sm mt-1">
                            @yield('subtitle', 'Modul Supervisi & Evaluasi Dinas Kesehatan')</p>
                    </div>
                </div>
            </div>

            <!-- SUCCESS ALERTS -->
            @if(session('success'))
                <div
                    class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl flex items-center gap-3 shadow-sm mb-6">
                    <i class="fas fa-check-circle text-xl"></i>
                    <p class="font-bold">{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- FORM SECTION -->
                <div class="lg:col-span-1">
                    <div class="bg-white p-6 md:p-8 rounded-[2rem] shadow-sm border border-slate-100 sticky top-6">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                            <div
                                class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center text-lg">
                                <i class="fas fa-edit"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800">Form @yield('title')</h3>
                        </div>

                        <form action="@yield('form_action', '#')" method="POST">
                            @csrf

                            @yield('form_content')

                            <div class="pt-6 mt-6 border-t border-slate-100">
                                <button type="submit"
                                    class="w-full py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-200 transition-all transform hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2">
                                    <i class="fas fa-save"></i> Simpan Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- HISTORY / TABLE SECTION -->
                <div class="lg:col-span-2">
                    <div class="bg-white p-6 md:p-8 rounded-[2rem] shadow-sm border border-slate-100">
                        <div class="flex items-center justify-between gap-3 mb-6 pb-4 border-b border-slate-100">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 bg-slate-50 text-slate-600 rounded-xl flex items-center justify-center text-lg">
                                    <i class="fas fa-history"></i>
                                </div>
                                <h3 class="text-lg font-bold text-slate-800">Riwayat Data</h3>
                            </div>
                            <!-- Pencarian Opsional -->
                            <div class="relative">
                                <input type="text" placeholder="Cari data..."
                                    class="text-sm rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 pl-10 bg-slate-50 py-2">
                                <i class="fas fa-search absolute left-3.5 top-3 text-slate-400"></i>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr
                                        class="text-xs font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                                        <th class="py-4 px-4 w-16">No</th>
                                        <th class="py-4 px-4">Tanggal Input</th>
                                        @yield('table_headers')
                                        <th class="py-4 px-4 text-center">Status</th>
                                        <th class="py-4 px-4 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm font-medium">
                                    @yield('table_rows')
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>