<nav x-data="{ open: false }" class="bg-gray-900 border-r border-gray-800 w-64 flex-shrink-0 hidden md:flex flex-col transition-all duration-300">
    
    <div class="h-20 flex items-center justify-center border-b border-gray-800">
        <div class="flex items-center gap-2">
            <span class="text-3xl">🚑</span>
            <span class="text-white font-bold text-xl tracking-wider">MEDZONE</span>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto py-6 space-y-2 px-3">

        @if(in_array(Auth::user()->role, ['super_admin', 'admin']))
            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 px-4">Administrator</div>
            
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-teal-900 text-white' : '' }}">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                <span class="font-medium">Dashboard Admin</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-xl transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-teal-900 text-white' : '' }}">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span class="font-medium">Kelola User</span>
            </a>
        @endif

        @if(Auth::user()->role == 'operator')
            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 px-4">Operator</div>

            <a href="{{ route('operator.dashboard') }}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-xl transition-colors {{ request()->routeIs('operator.dashboard') ? 'bg-teal-900 text-white' : '' }}">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path></svg>
                <span class="font-medium">Command Center</span>
            </a>
        @endif

        @if(in_array(Auth::user()->role, ['driver', 'nakes']))
            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 px-4">Lapangan</div>

            <a href="{{ route('lapangan.dashboard') }}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-xl transition-colors {{ request()->routeIs('lapangan.dashboard') ? 'bg-teal-900 text-white' : '' }}">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                <span class="font-medium">Tugas Saya</span>
            </a>
        @endif

        @if(in_array(Auth::user()->role, ['rumahsakit', 'puskesmas']))
            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 px-4">Faskes</div>

            <a href="{{ route('faskes.dashboard') }}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-xl transition-colors {{ request()->routeIs('faskes.dashboard') ? 'bg-teal-900 text-white' : '' }}">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                <span class="font-medium">Update Kamar</span>
            </a>
        @endif

        @if(in_array(Auth::user()->role, ['polisi', 'damkar', 'bpbd', 'dishub']))
            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 px-4">Monitoring</div>

            <a href="{{ route('operator.dashboard') }}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-xl transition-colors">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                <span class="font-medium">Peta Kejadian</span>
            </a>
        @endif

        @if(Auth::user()->role == 'masyarakat')
            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 px-4">Menu Warga</div>

            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-xl transition-colors {{ request()->routeIs('dashboard') ? 'bg-teal-900 text-white' : '' }}">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="font-medium">Home</span>
            </a>

            <a href="{{ route('emergency.create') }}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-xl transition-colors {{ request()->routeIs('emergency.*') ? 'bg-red-900 text-white' : '' }}">
                <svg class="w-6 h-6 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <span class="font-medium">Panggil Ambulan</span>
            </a>
        @endif

    </div>

    <div class="p-4 border-t border-gray-800">
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 mb-4 px-2 hover:bg-gray-800 rounded p-2 transition">
            <div class="w-10 h-10 rounded-full bg-teal-500 flex items-center justify-center text-white font-bold text-lg">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-400 truncate">{{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }}</p>
            </div>
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center px-4 py-2 border border-gray-700 rounded-lg text-sm text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Keluar
            </button>
        </form>
    </div>
</nav>

<div x-data="{ open: false }" class="md:hidden">
    <div class="bg-gray-900 text-white p-4 flex justify-between items-center">
        <span class="font-bold text-lg">MEDZONE</span>
        <button @click="open = !open" class="p-2"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg></button>
    </div>
    <div x-show="open" class="fixed inset-0 z-50 flex" style="display: none;">
        <div class="fixed inset-0 bg-black opacity-50" @click="open = false"></div>
        <div class="relative bg-gray-900 w-64 h-full flex flex-col p-4 space-y-4 overflow-y-auto">
            
            @if(in_array(Auth::user()->role, ['super_admin', 'admin']))
                <a href="{{ route('admin.dashboard') }}" class="text-white block">Dashboard Admin</a>
                <a href="{{ route('admin.users.index') }}" class="text-gray-300 block">Kelola User</a>
            @endif

            @if(Auth::user()->role == 'operator')
                <a href="{{ route('operator.dashboard') }}" class="text-white block">Command Center</a>
            @endif

            @if(Auth::user()->role == 'driver')
                <a href="{{ route('lapangan.dashboard') }}" class="text-white block">Tugas Saya</a>
            @endif

            @if(Auth::user()->role == 'masyarakat')
                <a href="{{ route('dashboard') }}" class="text-white block">Home</a>
                <a href="{{ route('emergency.create') }}" class="text-red-400 font-bold block">🚨 Panggil Ambulan</a>
            @endif

            <form method="POST" action="{{ route('logout') }}" class="mt-auto border-t border-gray-700 pt-4">
                @csrf
                <button class="text-red-400">Keluar</button>
            </form>
        </div>
    </div>
</div>