@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8 overflow-hidden">

        <div class="max-w-md w-full space-y-8 relative">
            <div class="text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center space-x-2">
                    <div class="bg-black text-white px-3 py-2 rounded-xl font-bold text-2xl">MK</div>
                </a>
                <h2 class="mt-4 text-3xl font-extrabold text-gray-900">Selamat Datang Kembali</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}"
                        class="font-medium text-indigo-600 hover:text-indigo-500 hover:underline">
                        Daftar di sini
                    </a>
                </p>
            </div>

            <!-- Login Card -->
            <div class="bg-white/20 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/20 p-8 space-y-6">
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-800">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                    </path>
                                </svg>
                            </div>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                autocomplete="email" autofocus
                                class="w-full pl-10 pr-4 py-3 bg-white/30 border border-white/20 rounded-xl text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition-all duration-200 @error('email') border-red-400 @enderror"
                                placeholder="email@contoh.com">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium text-gray-800">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                            </div>
                            <input id="password" name="password" type="password" required autocomplete="current-password"
                                class="w-full pl-10 pr-4 py-3 bg-white/30 border border-white/20 rounded-xl text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition-all duration-200 @error('password') border-red-400 @enderror"
                                placeholder="Password Anda">
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-sm text-indigo-600 hover:text-indigo-500 hover:underline">
                                Lupa password?
                            </a>
                        @endif
                    </div>


                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full mt-4 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold py-3 px-4 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 focus:ring-offset-transparent">
                        <span class="flex items-center justify-center">
                            Masuk
                            <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
    </style>
@endsection
