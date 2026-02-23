<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <a href="{{ route('operator.dashboard') }}"
                class="inline-flex items-center text-slate-500 hover:text-orange-600 font-bold mb-6 transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
            </a>

            <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h3 class="text-2xl font-black text-gray-800">🚑 Ambulan Swasta / Masyarakat</h3>
                        <p class="text-gray-500">Daftar unit ambulan non-dinas yang terdaftar dalam sistem.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse($ambulances as $amb)
                        <div
                            class="bg-white border border-slate-200 rounded-3xl p-6 hover:shadow-lg transition group relative overflow-hidden">
                            <div class="absolute top-0 right-0 p-4 opacity-10">
                                <i class="fas fa-ambulance text-6xl text-orange-500"></i>
                            </div>
                            <div class="relative z-10">
                                <div
                                    class="bg-orange-100 w-12 h-12 rounded-xl flex items-center justify-center text-orange-600 mb-4">
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4 class="text-lg font-black text-gray-800">{{ $amb->name }}</h4>
                                <p class="text-sm text-gray-500 mb-4">{{ $amb->plat_number }}</p>

                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-400">Tipe:</span>
                                        <span class="font-bold uppercase text-orange-600">{{ $amb->type }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-400">Kontak:</span>
                                        <span class="font-bold">{{ $amb->owner_contact ?? '-' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-400">Basecamp:</span>
                                        <span class="font-bold">{{ $amb->basecamp->name ?? 'Tidak Ada' }}</span>
                                    </div>
                                </div>

                                <div class="mt-6 flex gap-2">
                                    <a href="tel:{{ $amb->owner_contact }}"
                                        class="flex-1 bg-green-50 text-green-700 py-2 rounded-xl font-bold text-center text-sm hover:bg-green-100">
                                        <i class="fas fa-phone mr-1"></i> Telepon
                                    </a>
                                    <a href="https://wa.me/{{ $amb->owner_contact }}" target="_blank"
                                        class="flex-1 bg-green-500 text-white py-2 rounded-xl font-bold text-center text-sm hover:bg-green-600">
                                        <i class="fab fa-whatsapp mr-1"></i> WA
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-12 text-gray-400 bg-slate-50 rounded-3xl">
                            Belum ada data ambulan swasta/masyarakat.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>