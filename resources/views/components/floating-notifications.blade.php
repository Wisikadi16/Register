@if(Auth::check() && in_array(Auth::user()->role, ['operator', 'admin', 'super_admin', 'rumahsakit', 'klinik_utama', 'puskesmas', 'lab_medik', 'admin_dinkes']))
    <div x-data="{ notifOpen: false }" class="fixed bottom-6 right-6 z-50 font-sans">
        <!-- Floating Button -->
        <button @click="notifOpen = !notifOpen" @click.away="notifOpen = false"
            class="relative w-16 h-16 bg-white border border-slate-200 rounded-full shadow-2xl flex items-center justify-center text-slate-600 hover:text-blue-600 hover:border-blue-200 focus:outline-none transition-all duration-300 transform hover:-translate-y-1">
            <i class="fas fa-bell text-2xl"></i>

            @if($unreadCount > 0)
                <span class="absolute top-0 right-0 -mt-1 -mr-1 flex h-6 w-6">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rescue-red opacity-75"></span>
                    <span
                        class="relative inline-flex rounded-full h-6 w-6 bg-rescue-red text-white text-[10px] font-bold items-center justify-center border-2 border-white">
                        {{ $unreadCount > 99 ? '99+' : $unreadCount }}
                    </span>
                </span>
            @endif
        </button>

        <!-- Dropdown Panel (Slide Up) -->
        <div x-show="notifOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 scale-95"
            class="absolute bottom-20 right-0 w-80 sm:w-96 bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden"
            style="display: none;">

            <!-- Header -->
            <div class="px-5 py-4 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
                <h3 class="font-black text-charcoal flex items-center gap-2">
                    <i class="fas fa-bell text-blue-600"></i> Notifikasi
                </h3>
                @if($unreadCount > 0)
                    <span
                        class="bg-red-100 text-red-600 font-bold text-[10px] px-2 py-0.5 rounded-full uppercase tracking-wider">{{ $unreadCount }}
                        Baru</span>
                @endif
            </div>

            <!-- List -->
            <div class="max-h-[24rem] overflow-y-auto">
                @forelse($globalNotifications as $notif)
                    <a href="{{ $notif['url'] }}" @click.prevent="
                                    fetch('{{ route('notifications.read') }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                                        },
                                        body: JSON.stringify({
                                            id: '{{ $notif['id'] }}',
                                            type: '{{ $notif['type'] }}'
                                        })
                                    }).then(() => {
                                        window.location.href = '{{ $notif['url'] }}';
                                    });
                                "
                        class="block px-5 py-4 border-b border-slate-50 hover:bg-slate-50 transition-colors {{ $notif['is_unread'] ? 'bg-blue-50/30' : '' }}">
                        <div class="flex items-start gap-3">
                            <div
                                class="w-10 h-10 rounded-full flex-shrink-0 flex items-center justify-center 
                                                {{ $notif['type'] == 'emergency' ? 'bg-red-100 text-red-600' : 'bg-purple-100 text-purple-600' }}">
                                <i class="{{ $notif['icon'] }}"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start mb-1">
                                    <h4 class="text-sm font-bold text-charcoal truncate">{{ $notif['title'] }}</h4>
                                    <span
                                        class="text-[10px] text-slate-400 font-medium whitespace-nowrap ml-2">{{ $notif['time'] }}</span>
                                </div>
                                <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">{{ $notif['message'] }}</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="px-5 py-10 flex flex-col items-center justify-center text-center">
                        <div
                            class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 text-3xl mb-3">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <p class="text-sm font-bold text-slate-500">Tidak ada notifikasi baru</p>
                        <p class="text-[11px] text-slate-400 mt-1">Anda sudah melihat semuanya.</p>
                    </div>
                @endforelse
            </div>

            <!-- Footer -->
            @if(count($globalNotifications) > 0 && in_array(Auth::user()->role, ['operator']))
                <div class="px-5 py-3 border-t border-slate-100 bg-slate-50 text-center">
                    <a href="{{ route('operator.dashboard') }}"
                        class="text-xs font-bold text-blue-600 hover:text-blue-700 uppercase tracking-wider">
                        Ke Dashboard Operator <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            @endif
        </div>
    </div>
@endif