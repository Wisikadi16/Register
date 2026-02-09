<x-guest-layout>
    <div class="flex min-h-screen font-sans">

        <!-- Left Side: Hero / Branding -->
        <div
            class="hidden lg:flex w-1/2 bg-blue-900 flex-col justify-center items-center text-white relative overflow-hidden">
            <!-- Background Pattern/Image -->
            <div class="absolute inset-0 opacity-20 bg-cover bg-center"
                style="background-image: url('https://img.freepik.com/free-photo/doctors-holding-hands-together_1150-14336.jpg?w=1380'); background-blend-mode: multiply;">
            </div>
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900 to-slate-900 opacity-90"></div>

            <div class="relative z-10 text-center px-12">
                <div class="text-7xl mb-6 animate-bounce">🩺</div>
                <h2 class="text-4xl font-extrabold mb-4 tracking-tight">BERGABUNG SEKARANG</h2>
                <h3 class="text-xl font-semibold text-blue-200 mb-6">JADILAH BAGIAN DARI KAMI</h3>
                <div class="w-24 h-1 bg-blue-400 mx-auto rounded mb-6"></div>
                <p class="text-blue-100 text-lg leading-relaxed max-w-md mx-auto">
                    Daftarkan diri Anda untuk mengakses layanan kesehatan terpadu.<br>
                    <span class="text-white font-semibold">Mudah. Cepat. Terpercaya.</span>
                </p>
            </div>
        </div>

        <!-- Right Side: Register Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center bg-slate-50 px-6 py-12">
            <div class="w-full max-w-md bg-white p-10 rounded-3xl shadow-xl border border-blue-50">

                <div class="text-center mb-8">
                    <h3 class="text-3xl font-bold text-slate-800">Buat Akun Baru</h3>
                    <p class="text-slate-500 mt-2">Silahkan lengkapi data diri Anda</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Nama Lengkap')" class="text-slate-700 font-bold mb-1" />
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400 group-focus-within:text-blue-600 transition-colors"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <x-text-input id="name"
                                class="block mt-1 w-full pl-10 border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 rounded-xl py-3 transition-all duration-200"
                                type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                                placeholder="Nama Lengkap Anda" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email Address')" class="text-slate-700 font-bold mb-1" />
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400 group-focus-within:text-blue-600 transition-colors"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <x-text-input id="email"
                                class="block mt-1 w-full pl-10 border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 rounded-xl py-3 transition-all duration-200"
                                type="email" name="email" :value="old('email')" required autocomplete="username"
                                placeholder="nama@email.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" class="text-slate-700 font-bold mb-1" />
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400 group-focus-within:text-blue-600 transition-colors"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <x-text-input id="password"
                                class="block mt-1 w-full pl-10 border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 rounded-xl py-3 transition-all duration-200"
                                type="password" name="password" required autocomplete="new-password"
                                placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')"
                            class="text-slate-700 font-bold mb-1" />
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400 group-focus-within:text-blue-600 transition-colors"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <x-text-input id="password_confirmation"
                                class="block mt-1 w-full pl-10 border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 rounded-xl py-3 transition-all duration-200"
                                type="password" name="password_confirmation" required autocomplete="new-password"
                                placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <a class="text-sm text-slate-600 hover:text-blue-600 underline font-medium"
                            href="{{ route('login') }}">
                            {{ __('Sudah punya akun?') }}
                        </a>

                        <button
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-blue-500/30 transition duration-300 transform hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-blue-300">
                            {{ __('DAFTAR SEKARANG') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>