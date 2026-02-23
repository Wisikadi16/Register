<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-6">
                <a href="{{ route('lapangan.dashboard') }}"
                    class="inline-flex items-center text-slate-500 hover:text-blue-600 font-bold transition">
                    <i class="fas fa-arrow-left mr-2"></i> Dashboard
                </a>
                <h2 class="text-2xl font-black text-gray-800">📩 Pesan Masuk</h2>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="divide-y divide-slate-50">
                    @forelse($messages as $msg)
                        <div class="p-6 hover:bg-slate-50 transition cursor-pointer group">
                            <div class="flex justify-between items-start mb-2">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">
                                        {{ substr($msg->sender->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-800 group-hover:text-blue-600 transition">
                                            {{ $msg->sender->name }}</h4>
                                        <span class="text-xs text-slate-400">{{ $msg->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                @if(!$msg->is_read)
                                    <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                                @endif
                            </div>
                            <h5 class="font-bold text-gray-700 mt-2">{{ $msg->subject }}</h5>
                            <p class="text-slate-500 mt-1 text-sm line-clamp-2">{{ $msg->body }}</p>
                        </div>
                    @empty
                        <div class="p-12 text-center">
                            <div
                                class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                                <i class="fas fa-inbox text-3xl"></i>
                            </div>
                            <p class="text-slate-500 font-medium">Kotak masuk kosong.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>