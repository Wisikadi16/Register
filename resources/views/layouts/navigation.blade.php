<nav x-data="{ open: false }" class="bg-charcoal border-b border-slate-800 shadow-md">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center gap-2">
                    <span class="text-3xl">🚑</span>
                    @php
                        $role = Auth::user()->role;
                        $homeRoute = 'dashboard';

                        if ($role === 'super_admin') {
                            $homeRoute = 'super-admin.dashboard';
                        } elseif ($role === 'admin') {
                            $homeRoute = 'admin.dashboard';
                        } elseif ($role === 'ka') {
                            $homeRoute = 'ka.dashboard';
                        } elseif ($role === 'operator') {
                            $homeRoute = 'operator.dashboard';
                        } elseif ($role === 'atem') {
                            $homeRoute = 'atem.dashboard';
                        } elseif (in_array($role, ['driver', 'peserta_bhd'])) {
                            $homeRoute = 'lapangan.dashboard';
                        } elseif ($role === 'nakes') {
                            $homeRoute = 'nakes.dashboard';
                        } elseif ($role === 'sie_rujukan') {
                            $homeRoute = 'sie.dashboard';
                        } elseif ($role === 'rumahsakit') {
                            $homeRoute = 'faskes.dashboard';
                        } elseif ($role === 'klinik_utama') {
                            $homeRoute = 'klinik.dashboard';
                        } elseif (in_array($role, ['puskesmas', 'lab_medik'])) {
                            $homeRoute = 'puskesmas.dashboard';
                        }
                    @endphp
                    <a href="{{ route($homeRoute) }}"
                        class="text-white font-bold text-xl tracking-wider hover:text-gray-300 transition">
                        AMBULAN HEBAT
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if(Auth::user()->role == 'super_admin')
                        {{-- Super Admin --}}
                        <x-nav-link :href="route('super-admin.dashboard')"
                            :active="request()->routeIs('super-admin.dashboard')">
                            Dashboard
                        </x-nav-link>

                        {{-- Dropdown: Manajemen Sistem --}}
                        <div class="hidden sm:flex sm:items-center sm:ms-2">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-300 hover:text-white hover:border-gray-300 focus:outline-none focus:text-white focus:border-gray-300 transition duration-150 ease-in-out">
                                        <div>Manajemen Sistem</div>
                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('admin.users.index')">Kelola User</x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.logs.index')">Audit Log</x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.settings.index')">Pengaturan</x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.notifications.index')">Broadcast</x-dropdown-link>

                                </x-slot>
                            </x-dropdown>
                        </div>

                        <x-nav-link
                            href="https://lookerstudio.google.com/reporting/b6f0e801-078f-479e-aa20-3975c4d6d0c1/page/RmqZF"
                            target="_blank">
                            Monitoring PUSAKA
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->role == 'atem')
                        <x-nav-link :href="route('atem.dashboard')" :active="request()->routeIs('atem.dashboard')">
                            Dashboard
                        </x-nav-link>
                        <x-nav-link :href="route('atem.data')" :active="request()->routeIs('atem.data')">
                            Input Data
                        </x-nav-link>
                        <x-nav-link :href="route('atem.usulan')" :active="request()->routeIs('atem.usulan')">
                            Laporan Usulan
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->role == 'ka')
                        <x-nav-link :href="route('ka.dashboard')" :active="request()->routeIs('ka.dashboard')">
                            Dashboard KA
                        </x-nav-link>
                        <x-nav-link :href="route('ka.validasi.index')" :active="request()->routeIs('ka.validasi.*')">
                            Validasi Laporan
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->role == 'admin')
                        {{-- Admin Dinas --}}
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            Dashboard
                        </x-nav-link>

                        <x-nav-link :href="route('admin.dinkes.reports')"
                            :active="request()->routeIs('admin.dinkes.reports')">
                            Kejadian
                        </x-nav-link>

                        {{-- Dropdown: Pelayanan Medis --}}
                        <div class="hidden sm:flex sm:items-center sm:ms-2">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-300 hover:text-white hover:border-gray-300 focus:outline-none focus:text-white focus:border-gray-300 transition duration-150 ease-in-out">
                                        <div>Pelayanan Medis</div>
                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('admin.dinkes.referrals.index')">Validasi
                                        Rujukan</x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.dinkes.patient-recap')">Rekap
                                        Pasien</x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </div>

                        {{-- Dropdown: Aset & Maintenance --}}
                        <div class="hidden sm:flex sm:items-center sm:ms-2">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-300 hover:text-white hover:border-gray-300 focus:outline-none focus:text-white focus:border-gray-300 transition duration-150 ease-in-out">
                                        <div>Aset & Logistik</div>
                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <div class="block px-4 py-2 text-xs text-gray-400">Inventaris</div>
                                    <x-dropdown-link :href="route('admin.dinkes.inventory.index')">Data
                                        Aset</x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.dinkes.inventory.index', ['category' => 'household'])">Kebutuhan Rumah Tangga</x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.dinkes.maintenance.index')">Jadwal
                                        Maintenance</x-dropdown-link>
                                    <div class="border-t border-gray-100 my-1"></div>
                                    <div class="block px-4 py-2 text-xs text-gray-400">Operasional</div>
                                    <x-dropdown-link :href="route('admin.dinkes.logistics.index')">BBM &
                                        Service</x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.dinkes.utilities.index')">Listrik &
                                        Air</x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </div>

                        <x-nav-link
                            href="https://lookerstudio.google.com/reporting/b6f0e801-078f-479e-aa20-3975c4d6d0c1/page/RmqZF"
                            target="_blank">
                            Monitoring PUSAKA
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->role == 'operator')
                        <x-nav-link :href="route('operator.dashboard')" :active="request()->routeIs('operator.dashboard')">
                            Call Center
                        </x-nav-link>
                        <x-nav-link
                            href="https://lookerstudio.google.com/reporting/b6f0e801-078f-479e-aa20-3975c4d6d0c1/page/RmqZF"
                            target="_blank">
                            Monitoring PUSAKA
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->role == 'driver')
                        <x-nav-link :href="route('lapangan.dashboard')" :active="request()->routeIs('lapangan.dashboard')">
                            Tugas Saya
                        </x-nav-link>
                        <x-nav-link
                            href="https://lookerstudio.google.com/reporting/b6f0e801-078f-479e-aa20-3975c4d6d0c1/page/RmqZF"
                            target="_blank">
                            Monitoring PUSAKA
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->role == 'nakes')
                        <x-nav-link :href="route('nakes.dashboard')" :active="request()->routeIs('nakes.dashboard')">
                            Dashboard
                        </x-nav-link>
                        <x-nav-link :href="route('nakes.patients.index')"
                            :active="request()->routeIs('nakes.patients.index')">
                            Rekap Pasien
                        </x-nav-link>
                        <x-nav-link :href="route('nakes.reports.index')"
                            :active="request()->routeIs('nakes.reports.index')">
                            Laporan Usulan
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->role == 'sie_rujukan')
                        <x-nav-link :href="route('sie.dashboard')" :active="request()->routeIs('sie.dashboard')">
                            Dashboard
                        </x-nav-link>

                        {{-- Dropdown: Supervisi --}}
                        <div class="hidden sm:flex sm:items-center sm:ms-2">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-300 hover:text-white hover:border-gray-300 focus:outline-none focus:text-white focus:border-gray-300 transition duration-150 ease-in-out">
                                        <div>Supervisi</div>
                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('sie.spv.puskesmas')">SPV Puskesmas</x-dropdown-link>
                                    <x-dropdown-link :href="route('sie.spv.rs')">SPV Rumah Sakit</x-dropdown-link>
                                    <x-dropdown-link :href="route('sie.spv.lab')">SPV Lab Medis</x-dropdown-link>
                                    <x-dropdown-link :href="route('sie.spv.klinik')">SPV Klinik Utama</x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </div>

                        {{-- Dropdown: Penilaian & Validasi --}}
                        <div class="hidden sm:flex sm:items-center sm:ms-2">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-300 hover:text-white hover:border-gray-300 focus:outline-none focus:text-white focus:border-gray-300 transition duration-150 ease-in-out">
                                        <div>Penilaian & Validasi</div>
                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('sie.pkp.puskesmas')">PKP Puskesmas</x-dropdown-link>
                                    <x-dropdown-link :href="route('sie.stratifikasi.rs')">Stratifikasi RS</x-dropdown-link>
                                    <x-dropdown-link :href="route('sie.validasi.jadwal')">Validasi Jadwal</x-dropdown-link>
                                    <x-dropdown-link :href="route('sie.validasi.lplpo')">Validasi LPLPO</x-dropdown-link>
                                    <x-dropdown-link :href="route('sie.validasi.ah')">Validasi Data AH</x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </div>

                        <x-nav-link :href="route('sie.laporan.bhd')" :active="request()->routeIs('sie.laporan.bhd')">
                            Laporan BHD
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->role == 'masyarakat')
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            Home
                        </x-nav-link>
                        <x-nav-link :href="route('emergency.create')" :active="request()->routeIs('emergency.*')"
                            class="text-red-400 font-bold">
                            Panggil Ambulan
                        </x-nav-link>
                        <x-nav-link
                            href="https://lookerstudio.google.com/reporting/b6f0e801-078f-479e-aa20-3975c4d6d0c1/page/RmqZF"
                            target="_blank">
                            Monitoring PUSAKA
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300 bg-gray-800 hover:text-white focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-6 h-6 rounded-full bg-teal-500 flex items-center justify-center text-white text-xs font-bold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                {{ Auth::user()->name }}
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-charcoal border-t border-slate-800">
        <div class="pt-2 pb-3 space-y-1">
            @if(Auth::user()->role == 'super_admin')
                <x-responsive-nav-link :href="route('super-admin.dashboard')"
                    :active="request()->routeIs('super-admin.dashboard')">Dashboard</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.users.index')"
                    :active="request()->routeIs('admin.users.*')">Kelola User</x-responsive-nav-link>
                <x-responsive-nav-link
                    href="https://lookerstudio.google.com/reporting/b6f0e801-078f-479e-aa20-3975c4d6d0c1/page/RmqZF"
                    target="_blank">Monitoring PUSAKA</x-responsive-nav-link>
            @endif

            @if(Auth::user()->role == 'atem')
                <x-responsive-nav-link :href="route('atem.dashboard')"
                    :active="request()->routeIs('atem.dashboard')">Dashboard</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('atem.data')" :active="request()->routeIs('atem.data')">Input
                    Data</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('atem.usulan')" :active="request()->routeIs('atem.usulan')">Laporan
                    Usulan</x-responsive-nav-link>
            @endif

            @if(Auth::user()->role == 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')"
                    :active="request()->routeIs('admin.dashboard')">Dashboard</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.dinkes.reports')"
                    :active="request()->routeIs('admin.dinkes.reports')">Kejadian</x-responsive-nav-link>
                <x-responsive-nav-link
                    href="https://lookerstudio.google.com/reporting/b6f0e801-078f-479e-aa20-3975c4d6d0c1/page/RmqZF"
                    target="_blank">Monitoring PUSAKA</x-responsive-nav-link>
            @endif

            @if(Auth::user()->role == 'operator')
                <x-responsive-nav-link :href="route('operator.dashboard')"
                    :active="request()->routeIs('operator.dashboard')">Call Center</x-responsive-nav-link>
                <x-responsive-nav-link
                    href="https://lookerstudio.google.com/reporting/b6f0e801-078f-479e-aa20-3975c4d6d0c1/page/RmqZF"
                    target="_blank">Monitoring PUSAKA</x-responsive-nav-link>
            @endif

            @if(Auth::user()->role == 'driver')
                <x-responsive-nav-link :href="route('lapangan.dashboard')"
                    :active="request()->routeIs('lapangan.dashboard')">Tugas Saya</x-responsive-nav-link>
                <x-responsive-nav-link
                    href="https://lookerstudio.google.com/reporting/b6f0e801-078f-479e-aa20-3975c4d6d0c1/page/RmqZF"
                    target="_blank">Monitoring PUSAKA</x-responsive-nav-link>
            @endif

            @if(Auth::user()->role == 'nakes')
                <x-responsive-nav-link :href="route('nakes.dashboard')"
                    :active="request()->routeIs('nakes.dashboard')">Dashboard</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('nakes.patients.index')"
                    :active="request()->routeIs('nakes.patients.index')">Rekap Pasien</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('nakes.reports.index')"
                    :active="request()->routeIs('nakes.reports.index')">Laporan Usulan</x-responsive-nav-link>
            @endif

            @if(Auth::user()->role == 'sie_rujukan')
                <x-responsive-nav-link :href="route('sie.dashboard')"
                    :active="request()->routeIs('sie.dashboard')">Dashboard</x-responsive-nav-link>
                <div class="px-4 py-2 text-xs text-gray-400 font-bold uppercase">Supervisi</div>
                <x-responsive-nav-link :href="route('sie.spv.puskesmas')"
                    :active="request()->routeIs('sie.spv.puskesmas')">SPV Puskesmas</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('sie.spv.rs')" :active="request()->routeIs('sie.spv.rs')">SPV Rumah
                    Sakit</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('sie.spv.lab')" :active="request()->routeIs('sie.spv.lab')">SPV Lab
                    Medis</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('sie.spv.klinik')" :active="request()->routeIs('sie.spv.klinik')">SPV
                    Klinik Utama</x-responsive-nav-link>

                <div class="px-4 py-2 text-xs text-gray-400 font-bold uppercase mt-2">Penilaian & Validasi</div>
                <x-responsive-nav-link :href="route('sie.pkp.puskesmas')"
                    :active="request()->routeIs('sie.pkp.puskesmas')">PKP Puskesmas</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('sie.stratifikasi.rs')"
                    :active="request()->routeIs('sie.stratifikasi.rs')">Stratifikasi RS</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('sie.validasi.jadwal')"
                    :active="request()->routeIs('sie.validasi.jadwal')">Validasi Jadwal</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('sie.validasi.lplpo')"
                    :active="request()->routeIs('sie.validasi.lplpo')">Validasi LPLPO</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('sie.validasi.ah')"
                    :active="request()->routeIs('sie.validasi.ah')">Validasi Data AH</x-responsive-nav-link>

                <div class="px-4 py-2 text-xs text-gray-400 font-bold uppercase mt-2">Laporan</div>
                <x-responsive-nav-link :href="route('sie.laporan.bhd')"
                    :active="request()->routeIs('sie.laporan.bhd')">Laporan BHD</x-responsive-nav-link>
            @endif

            @if(Auth::user()->role == 'masyarakat')
                <x-responsive-nav-link :href="route('dashboard')"
                    :active="request()->routeIs('dashboard')">Home</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('emergency.create')" :active="request()->routeIs('emergency.*')"
                    class="text-red-400 font-bold">Panggil Ambulan</x-responsive-nav-link>
                <x-responsive-nav-link
                    href="https://lookerstudio.google.com/reporting/b6f0e801-078f-479e-aa20-3975c4d6d0c1/page/RmqZF"
                    target="_blank">Monitoring PUSAKA</x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-700">
            <div class="px-4">
                <div class="font-medium text-base text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>