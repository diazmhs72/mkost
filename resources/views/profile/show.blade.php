@extends('layouts.app')

@section('content')
    <main class="flex-grow container mx-auto p-4 sm:p-6 lg:p-8">
        <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2 text-center">Profil Saya</h1>
            <p class="text-gray-500 mb-8 text-center">Kelola informasi akun dan kata sandi Anda.</p>

            @if (session('success'))
                <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                    <p class="font-bold">Sukses</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Informasi Profil -->
                <div>
                    <h2 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">Informasi Akun</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('name') border-red-500 @enderror"
                                required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('email') border-red-500 @enderror"
                                required>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Ganti Password -->
                <div>
                    <h2 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">Ganti Password</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                            <input type="password" id="password" name="password"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('password') border-red-500 @enderror">
                            <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah password.</p>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi
                                Password Baru</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit"
                        class="bg-indigo-600 text-white px-6 py-2 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection
