<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <a href="{{ route('operator.dashboard') }}"
                class="inline-flex items-center text-slate-500 hover:text-green-600 font-bold mb-6 transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
            </a>

            <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h3 class="text-2xl font-black text-gray-800">📖 Kontak Tim Lapangan</h3>
                        <p class="text-gray-500">Hubungi Driver atau Nakes yang sedang bertugas.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($drivers as $driver)
                        <div
                            class="bg-white border border-slate-200 rounded-3xl p-6 hover:shadow-lg transition flex items-center gap-4">
                            <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center text-2xl">
                                {{ substr($driver->name, 0, 1) }}
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-800">{{ $driver->name }}</h4>
                                <span
                                    class="text-xs font-bold uppercase {{ $driver->role == 'driver' ? 'text-blue-600 bg-blue-50 px-2 py-0.5 rounded' : 'text-pink-600 bg-pink-50 px-2 py-0.5 rounded' }}">
                                    {{ $driver->role }}
                                </span>
                                <div class="flex gap-2 mt-3">
                                    @if($driver->phone_number)
                                        <a href="https://wa.me/{{ $driver->phone_number }}" target="_blank"
                                            class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center hover:bg-green-600 transition">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        <a href="tel:{{ $driver->phone_number }}"
                                            class="w-8 h-8 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center hover:bg-slate-300 transition">
                                            <i class="fas fa-phone"></i>
                                        </a>
                                    @else
                                        <span class="text-xs text-red-400 italic">No Phone</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-12 text-gray-400">
                            Tidak ada data driver aktif.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>