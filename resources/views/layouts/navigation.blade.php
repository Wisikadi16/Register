<nav x-data="{ open: false }"
    class="bg-gray-900 border-r border-gray-800 w-64 flex-shrink-0 hidden md:flex flex-col transition-all duration-300">
    <!-- Logo -->
    <div class="h-20 flex items-center justify-center border-b border-gray-800">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
            <span class="text-3xl">🚑</span>
            <span class="text-white font-bold text-xl tracking-wider">MEDZONE</span>
        </a>
    </div>

    <!-- Navigation Links -->
    <div class="flex-1 overflow-y-auto py-6 space-y-2 px-3">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
            class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-xl transition-colors {{ request()->routeIs('dashboard') ? 'bg-pusaka text-white shadow-lg shadow-teal-900/50' : '' }}">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                </path>
            </svg>
            <span class="font-medium">Dashboard</span>
        </a>

        <!-- Emergency Service (Masyarakat) -->
        <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mt-6 mb-2 px-4">Layanan Darurat</div>

        <a href="{{ route('emergency.create') }}"
            class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-xl transition-colors {{ request()->routeIs('emergency.*') ? 'bg-pusaka text-white' : '' }}">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                </path>
            </svg>
            <span class="font-medium">Panggil Ambulan</span>
        </a>

        <!-- Other Menus (Conditional based on Role could go here, for now static common) -->
        <a href="{{ route('profile.edit') }}"
            class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-xl transition-colors {{ request()->routeIs('profile.edit') ? 'bg-pusaka text-white' : '' }}">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <span class="font-medium">Profil Saya</span>
        </a>
    </div>

    <!-- User Profile & Logout -->
    <div class="p-4 border-t border-gray-800">
        <div class="flex items-center gap-3 mb-4 px-2">
            <div
                class="w-10 h-10 rounded-full bg-teal-500 flex items-center justify-center text-white font-bold text-lg">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center justify-center px-4 py-2 border border-gray-700 rounded-lg text-sm text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                    </path>
                </svg>
                Keluar
            </button>
        </form>
    </div>
</nav>

<!-- Mobile Navigation (Overlay) -->
<div x-data="{ open: false }" class="md:hidden">
    <!-- Mobile Header Trigger -->
    <div class="bg-gray-900 text-white p-4 flex justify-between items-center">
        <span class="font-bold text-lg">MEDZONE</span>
        <button @click="open = !open" class="p-2 rounded-md hover:bg-gray-800">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>
    </div>

    <!-- Mobile Drawer -->
    <div x-show="open" class="fixed inset-0 z-40 flex">
        <div class="fixed inset-0 bg-black opacity-50" @click="open = false"></div>
        <div class="relative bg-gray-900 w-64 h-full flex flex-col p-4 space-y-4">
            <!-- Links Replica for Mobile -->
            <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white py-2 block">Dashboard</a>
            <a href="{{ route('emergency.create') }}" class="text-gray-300 hover:text-white py-2 block">Panggil
                Ambulan</a>
            <a href="{{ route('profile.edit') }}" class="text-gray-300 hover:text-white py-2 block">Profil</a>

            <form method="POST" action="{{ route('logout') }}" class="pt-4 border-t border-gray-800">
                @csrf
                <button class="text-red-400">Logout</button>
            </form>
        </div>
    </div>
</div>