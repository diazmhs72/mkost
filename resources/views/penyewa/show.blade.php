@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4 md:p-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row">

                <!-- Kolom Kiri: Informasi Detail -->
                <div class="w-full md:w-5/12 p-6 flex flex-col justify-between">
                    <div>
                        <!-- Nama Kost dan Deskripsi Singkat -->
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $kost->nama }}</h1>
                        <p class="text-gray-600 mb-6">{{ $kost->deskripsi }}</p>

                        <!-- Harga -->
                        <div class="mb-6">
                            <p class="text-sm text-gray-500">Harga Sewa</p>
                            <p class="text-2xl font-bold text-indigo-600">Rp
                                {{ number_format($kost->harga, 0, ',', '.') }}<span
                                    class="text-lg font-normal text-gray-500">/bln</span></p>
                        </div>

                        <!-- Detail Fasilitas dari Database -->
                        <div class="space-y-3 text-gray-700">
                            <div class="flex justify-between">
                                <span class="font-semibold">Tipe Kamar</span>
                                <span>{{ $kost->tipe_kamar ?? 'Data tidak tersedia' }}</span>
                            </div>
                            <hr>
                            <div class="flex justify-between">
                                <span class="font-semibold">Kamar Mandi</span>
                                <span>{{ $kost->kamar_mandi ?? 'Data tidak tersedia' }}</span>
                            </div>
                            <hr>
                            <div class="flex justify-between">
                                <span class="font-semibold">Fasilitas</span>
                                <span class="text-right">{{ $kost->fasilitas ?? 'Data tidak tersedia' }}</span>
                            </div>
                            <hr>
                            <div class="flex justify-between">
                                <span class="font-semibold">Pemilik</span>
                                {{-- Mengambil nama dari relasi user --}}
                                <span>{{ $kost->user->name ?? 'Data tidak tersedia' }}</span>
                            </div>
                        </div>

                        <!-- Status dan Kategori (Tags) dari Database -->
                        <div class="flex items-center gap-3 mt-6">
                            @if ($kost->gender)
                                <span
                                    class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">{{ ucfirst($kost->gender) }}</span>
                            @endif
                            @if ($kost->status)
                                <span
                                    class="bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full">{{ ucfirst($kost->status) }}</span>
                            @endif
                        </div>

                        <!-- Peta Lokasi -->
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Lokasi</h3>
                            <div class="rounded-lg overflow-hidden">
                                <iframe src="https://maps.google.com/maps?q={{ urlencode($kost->lokasi) }}&output=embed"
                                    width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy">
                                </iframe>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-8 flex flex-col sm:flex-row gap-3">
                        <a href="https://wa.me/6281234567890" target="_blank"
                            class="w-full text-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-4 rounded-lg transition duration-300">
                            Hubungi Pemilik
                        </a>
                    </div>
                </div>

                <!-- Kolom Kanan: Gambar -->
                <div class="w-full md:w-7/12">
                    <img src="{{ asset('storage/' . $kost->gambar) }}" alt="Foto {{ $kost->nama }}"
                        class="w-full h-full object-cover" style="min-height: 400px;">
                </div>

            </div>
        </div>
    </div>
@endsection
