@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <a href="{{ route('home') }}" class="flex items-center justify-center space-x-2">
                    <div class="bg-black text-white px-3 py-2 rounded font-bold text-2xl">MK</div>
                    <h2 class="text-center text-3xl font-extrabold text-gray-900">Buat Akun Baru</h2>
                </a>
                <p class="mt-4 text-center text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                        Masuk di sini
                    </a>
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-lg space-y-6">
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required
                            autocomplete="name" autofocus
                            class="mt-1 appearance-none rounded-md relative block w-full px-3 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Nama Anda">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required
                            autocomplete="email"
                            class="mt-1 appearance-none rounded-md relative block w-full px-3 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="email@contoh.com">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">Daftar Sebagai</label>
                        <select id="role" name="role" required
                            class="mt-1 appearance-none rounded-md relative block w-full px-3 py-2 border @error('role') border-red-500 @else border-gray-300 @enderror bg-white text-gray-500 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="" disabled {{ old('role') ? '' : 'selected' }}>Pilih peran Anda...</option>
                            <option value="penyewa" {{ old('role') == 'penyewa' ? 'selected' : '' }}>Penyewa (Pencari Kost)
                            </option>
                            <option value="pemilik" {{ old('role') == 'pemilik' ? 'selected' : '' }}>Pemilik Kost</option>
                        </select>
                        @error('role')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" name="password" type="password" required autocomplete="new-password"
                            class="mt-1 appearance-none rounded-md relative block w-full px-3 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Minimal 8 karakter">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password-confirm" class="block text-sm font-medium text-gray-700">Konfirmasi
                            Password</label>
                        <input id="password-confirm" name="password_confirmation" type="password" required
                            autocomplete="new-password"
                            class="mt-1 appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Ketik ulang password Anda">
                    </div>

                    <div>
                        <button type="submit"
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300">
                            Buat Akun
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
