@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4 md:p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Kost Saya</h1>
            <a href="{{ route('kost.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
                + Tambah Kost Baru
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($kosts as $kost)
                <div class="bg-white border rounded-lg shadow-lg overflow-hidden flex flex-col">
                    <img src="{{ asset('storage/' . $kost->gambar) }}" alt="Foto {{ $kost->nama }}"
                        class="w-full h-48 object-cover">

                    <div class="p-4 flex flex-col flex-grow">
                        <h2 class="text-xl font-bold text-gray-800">{{ $kost->nama }}</h2>
                        <p class="text-gray-600 mt-1">{{ $kost->lokasi }}</p>
                        <p class="text-lg font-semibold text-indigo-600 mt-2">Rp
                            {{ number_format($kost->harga, 0, ',', '.') }}/bulan</p>

                        {{-- Spacer untuk mendorong tombol ke bawah --}}
                        <div class="flex-grow"></div>

                        {{-- Tombol Aksi --}}
                        <div class="mt-4 pt-4 border-t border-gray-200 flex justify-end items-center gap-3">
                            <a href="{{ route('kost.edit', $kost) }}"
                                class="text-sm bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('kost.destroy', $kost) }}"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data kost ini? Tindakan ini tidak dapat dibatalkan.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-sm bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12 bg-gray-50 rounded-lg">
                    <p class="text-gray-500">Anda belum memiliki data kost.</p>
                    <a href="{{ route('kost.create') }}"
                        class="mt-4 inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
                        + Tambah Kost Pertama Anda
                    </a>
                </div>
            @endforelse
        </div>
    </div>
@endsection
