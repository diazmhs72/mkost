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

                        <!-- Detail Fasilitas -->
                        <div class="space-y-3 text-gray-700">
                            <div class="flex justify-between">
                                <span class="font-semibold">Tipe Kamar</span>
                                <!-- Ganti dengan data dinamis jika ada, contoh: $kost->tipe_kamar -->
                                <span>Single Bed</span>
                            </div>
                            <hr>
                            <div class="flex justify-between">
                                <span class="font-semibold">Kamar Mandi</span>
                                <!-- Ganti dengan data dinamis jika ada, contoh: $kost->kamar_mandi -->
                                <span>Dalam</span>
                            </div>
                            <hr>
                            <div class="flex justify-between">
                                <span class="font-semibold">Fasilitas</span>
                                <!-- Ganti dengan data dinamis jika ada, contoh: $kost->fasilitas -->
                                <span>Wi-Fi, Lemari, CCTV, Dapur</span>
                            </div>
                            <hr>
                            <div class="flex justify-between">
                                <span class="font-semibold">Pemilik</span>
                                <!-- Ganti dengan nama pemilik dinamis, contoh: $kost->pemilik->nama -->
                                <span>Ibu Sari</span>
                            </div>
                        </div>

                        <!-- Status dan Kategori (Tags) -->
                        <div class="flex items-center gap-3 mt-6">
                            <!-- Ganti kondisi 'khusus_putra' dengan data Anda, contoh: $kost->kategori == 'Putra' -->
                            <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">Khusus
                                Putra</span>
                            <!-- Ganti kondisi 'tersedia' dengan data Anda, contoh: $kost->status == 'Tersedia' -->
                            <span
                                class="bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full">Tersedia</span>
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
                        <form action="{{ route('booking.store') }}" method="POST" class="w-full">
                            @csrf
                            <input type="hidden" name="kost_id" value="{{ $kost->id }}">
                            <button type="submit"
                                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300">
                                Booking Sekarang
                            </button>
                        </form>
                        <!-- Ganti nomor telepon dengan data dinamis, contoh: $kost->pemilik->telepon -->
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
