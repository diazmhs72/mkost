@extends('layouts.app')

@section('content')
    {{-- Head section untuk menambahkan Font Awesome untuk ikon --}}

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
            xintegrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <main class="bg-gray-100 py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-0">

                    <!-- Kolom Kiri: Informasi Detail -->
                    <div class="lg:col-span-3 p-6 md:p-10">
                        <!-- Header: Nama, Lokasi, Tags -->
                        <div class="mb-6 pb-6 border-b border-gray-200">
                            <div class="flex items-center gap-4 mb-3">
                                @if ($kost->status == 'Tersedia')
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1.5 rounded-full flex items-center gap-2"><i
                                            class="fas fa-check-circle"></i>Tersedia</span>
                                @else
                                    <span
                                        class="bg-red-100 text-red-800 text-xs font-bold px-3 py-1.5 rounded-full flex items-center gap-2"><i
                                            class="fas fa-times-circle"></i>Penuh</span>
                                @endif
                                <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1.5 rounded-full">Khusus
                                    {{ ucfirst($kost->gender) }}</span>
                            </div>
                            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900">{{ $kost->nama }}</h1>
                            <div class="flex items-center text-gray-500 mt-3">
                                <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>
                                <span>{{ $kost->lokasi }}</span>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-8">
                            <h2 class="text-xl font-bold text-gray-800 mb-3">Deskripsi Kost</h2>
                            <p class="text-gray-600 leading-relaxed">{{ $kost->deskripsi }}</p>
                        </div>

                        <!-- Fasilitas Utama -->
                        <div class="mb-8">
                            <h2 class="text-xl font-bold text-gray-800 mb-4">Fasilitas Utama</h2>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 text-gray-700">
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                    <i class="fas fa-bed w-6 text-center text-indigo-500 mr-3"></i>
                                    <span>{{ $kost->tipe_kamar ?? 'N/A' }}</span>
                                </div>
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                    <i class="fas fa-bath w-6 text-center text-indigo-500 mr-3"></i>
                                    <span>KM {{ $kost->kamar_mandi ?? 'N/A' }}</span>
                                </div>
                                {{-- Mem-parsing fasilitas dari string yang dipisahkan koma --}}
                                @if ($kost->fasilitas)
                                    @foreach (explode(',', $kost->fasilitas) as $fasilitas)
                                        @if (trim($fasilitas))
                                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                                <i class="fas fa-check-circle w-6 text-center text-indigo-500 mr-3"></i>
                                                <span>{{ trim($fasilitas) }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <!-- Peta Lokasi -->
                        <div>
                            <h2 class="text-xl font-bold text-gray-800 mb-4">Lokasi di Peta</h2>
                            <div class="rounded-xl overflow-hidden border">
                                {{-- PERBAIKAN DI SINI --}}
                                <iframe src="https://maps.google.com/maps?q={{ urlencode($kost->lokasi) }}&output=embed"
                                    width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
                                </iframe>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Booking & Gambar -->
                    <div class="lg:col-span-2 p-6 md:p-10 lg:border-l lg:border-gray-200 flex flex-col">
                        <!-- Gambar -->
                        <div class="mb-6 rounded-2xl overflow-hidden shadow-lg">
                            <img src="{{ asset('storage/' . $kost->gambar) }}" alt="Foto {{ $kost->nama }}"
                                class="w-full h-64 object-cover">
                        </div>

                        <!-- Kartu Booking & Harga -->
                        <div
                            class="bg-gray-50 rounded-2xl p-6 border border-gray-200 flex-grow flex flex-col justify-between">
                            <div>
                                <p class="text-sm text-gray-500">Harga Sewa Mulai Dari</p>
                                <p class="text-4xl font-bold text-indigo-600 my-2">
                                    Rp {{ number_format($kost->harga, 0, ',', '.') }}
                                    <span class="text-lg font-normal text-gray-500">/bulan</span>
                                </p>
                            </div>

                            <div class="mt-6 space-y-3">
                                @if (isset($hasBooking) && $hasBooking)
                                    <button disabled
                                        class="w-full text-center bg-gray-400 text-white font-bold py-3 px-4 rounded-xl cursor-not-allowed">
                                        <i class="fas fa-check mr-2"></i> Anda Sudah Memesan
                                    </button>
                                @else
                                    <form action="{{ route('booking.store') }}" method="POST" class="w-full">
                                        @csrf
                                        <input type="hidden" name="kost_id" value="{{ $kost->id }}">
                                        <button type="submit"
                                            class="w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-xl transition duration-300 shadow-lg hover:shadow-indigo-500/50 transform hover:-translate-y-0.5">
                                            Booking Sekarang
                                        </button>
                                    </form>
                                @endif
                                <a href="https://wa.me/{{ $kost->user->telepon ?? '' }}" target="_blank"
                                    class="w-full block text-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-4 rounded-xl transition duration-300">
                                    <i class="fab fa-whatsapp mr-2"></i> Hubungi Pemilik
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
