@extends('layouts.app')

@section('content')
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                Kelola User
            </h2>

            <!-- Notifikasi Sukses -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Menampilkan Error Validasi -->
            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Oops!</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 font-semibold text-gray-600">Nama</th>
                            <th class="p-3 font-semibold text-gray-600">Email</th>
                            <th class="p-3 font-semibold text-gray-600">Role</th>
                            <th class="p-3 font-semibold text-gray-600 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="border-t hover:bg-gray-50 align-top">
                                <form method="POST" action="{{ route('admin.users.update', $user) }}">
                                    @csrf
                                    @method('PUT')

                                    <td class="p-2">
                                        <input name="name" value="{{ old('name', $user->name) }}"
                                            class="w-full border rounded-md p-2 focus:ring-blue-500 focus:border-blue-500">
                                    </td>
                                    <td class="p-2">
                                        <input name="email" type="email" value="{{ old('email', $user->email) }}"
                                            class="w-full border rounded-md p-2 focus:ring-blue-500 focus:border-blue-500">
                                    </td>
                                    <td class="p-2">
                                        <select name="role"
                                            class="w-full border rounded-md p-2 focus:ring-blue-500 focus:border-blue-500">
                                            <option value="penyewa" @selected($user->role == 'penyewa')>Penyewa</option>
                                            <option value="pemilik" @selected($user->role == 'pemilik')>Pemilik</option>
                                            <option value="admin" @selected($user->role == 'admin')>Admin</option>
                                        </select>
                                    </td>
                                    <td class="p-2 text-center">
                                        <div class="flex justify-center items-center gap-2">
                                            <button type="submit"
                                                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                                                Simpan
                                            </button>
                                </form> <!-- Form update ditutup di sini -->

                                <!-- Form terpisah untuk Hapus -->
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                                        Hapus
                                    </button>
                                </form>
            </div>
            </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center p-4 text-gray-500">
                    Tidak ada data user.
                </td>
            </tr>
            @endforelse
            </tbody>
            </table>
        </div>

        <!-- Link Paginasi -->
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
    </div>
@endsection
