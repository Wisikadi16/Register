<x-guest-layout>
    <div class="flex min-h-screen font-sans">

        <!-- Left Side: Hero / Branding -->
        <div class="hidden lg:flex w-1/2 bg-teal-900 flex-col justify-center items-center text-white relative overflow-hidden">
            <!-- Background Pattern/Image -->
            <div class="absolute inset-0 opacity-20 bg-cover bg-center"
                 style="background-image: url('https://img.freepik.com/free-vector/clean-medical-background_53876-97927.jpg?w=1380&t=st=1691234567~exp=1691235167~hmac=...'); background-blend-mode: multiply;">
            </div>
            <div class="absolute inset-0 bg-gradient-to-br from-teal-900 to-black opacity-80"></div>

            <div class="relative z-10 text-center px-12">
                <div class="text-7xl mb-6 animate-pulse">🚑</div>
                <h2 class="text-5xl font-extrabold mb-4 tracking-tight">MEDZONE</h2>
                <h3 class="text-2xl font-semibold text-teal-200 mb-6">EMERGENCY 119</h3>
                <div class="w-24 h-1 bg-teal-500 mx-auto rounded mb-6"></div>
                <p class="text-gray-300 text-lg leading-relaxed max-w-md mx-auto">
                    Sistem Penanggulangan Gawat Darurat Terpadu.<br>
                    <span class="text-teal-400 font-semibold">Cepat. Tepat. Selamat.</span>
                </p>
            </div>

            <div class="absolute bottom-8 w-full text-center text-teal-500/50 text-xs">
                &copy; {{ date('Y') }} Sistem Informasi Kesehatan
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center bg-gray-50/50 px-6 py-12">
            <div class="w-full max-w-md bg-white p-10 rounded-3xl shadow-2xl border border-gray-100">

                <div class="text-center mb-10">
                    <h3 class="text-3xl font-bold text-gray-900">Selamat Datang</h3>
                    <p class="text-gray-500 mt-2">Masuk untuk mengakses layanan darurat</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 font-bold mb-1" />
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-teal-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <x-text-input id="email"
                                class="block mt-1 w-full pl-10 border-gray-200 bg-gray-50 focus:bg-white focus:border-teal-500 focus:ring-teal-500 rounded-xl py-3 transition-all duration-200"
                                type="email" name="email" :value="old('email')" required autofocus
                                autocomplete="username" placeholder="nama@email.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-bold mb-1" />
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-teal-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <x-text-input id="password"
                                class="block mt-1 w-full pl-10 border-gray-200 bg-gray-50 focus:bg-white focus:border-teal-500 focus:ring-teal-500 rounded-xl py-3 transition-all duration-200"
                                type="password" name="password" required autocomplete="current-password"
                                placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-teal-600 shadow-sm focus:ring-teal-500"
                                name="remember">
                            <span class="ms-2 text-sm text-gray-600 hover:text-gray-900">{{ __('Ingat Saya') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-teal-600 hover:text-teal-800 font-semibold rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500"
                                href="{{ route('password.request') }}">
                                {{ __('Lupa Password?') }}
                            </a>
                        @endif
                    </div>

                    <button
                        class="w-full bg-pusaka hover:bg-pusaka-dark text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-teal-500/30 transition duration-300 transform hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-teal-300">
                        {{ __('MASUK AGENT') }}
                    </button>

                    <div class="mt-8 text-center text-sm text-gray-500">
                        Belum memiliki akun?
                        <a href="{{ route('register') }}" class="text-teal-600 font-bold hover:underline ml-1">
                            Daftar Disini
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>