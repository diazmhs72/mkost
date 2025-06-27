@extends('layouts.app')

@section('content')
    {{-- Head section untuk menambahkan Font Awesome untuk ikon --}}

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
            xintegrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    {{-- Hero Section --}}
    <section class="relative h-[50vh] min-h-[400px] flex items-center justify-center text-center">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0">
            <img src="{{ asset('img/bg-lp.png') }}" alt="Ilustrasi pemandangan kota" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 to-transparent"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 px-4 text-white">
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight drop-shadow-lg">Temukan Kost Impian Anda</h1>
            <p class="mt-4 text-lg md:text-xl max-w-3xl mx-auto drop-shadow-md">
                Cari & temukan kost idaman dengan mudah, cepat, dan sesuai keinginan Anda.
            </p>
        </div>
    </section>

    {{-- Filter Form Section --}}
    <section class="bg-gray-100 mt-16 relative z-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-2xl p-6 md:p-8">
                <form action="{{ route('index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    {{-- Lokasi --}}
                    <div class="md:col-span-2">
                        <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                            </div>
                            <input id="lokasi" name="lokasi" placeholder="Cari kota atau area..."
                                value="{{ request('lokasi') }}"
                                class="w-full pl-10 pr-4 py-3 rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition" />
                        </div>
                    </div>

                    {{-- Gender --}}
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Tipe Kost</label>
                        <select id="gender" name="gender"
                            class="w-full px-4 py-3 rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">
                            <option value="">Semua Tipe</option>
                            <option value="pria" {{ request('gender') == 'pria' ? 'selected' : '' }}>Pria</option>
                            <option value="wanita" {{ request('gender') == 'wanita' ? 'selected' : '' }}>Wanita</option>
                            <option value="campur" {{ request('gender') == 'campur' ? 'selected' : '' }}>Campur</option>
                        </select>
                    </div>

                    {{-- Tombol Cari --}}
                    <div>
                        <button
                            class="w-full bg-indigo-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg hover:shadow-indigo-500/50 transform hover:-translate-y-0.5">
                            <i class="fas fa-search mr-2"></i>Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Kost Cards Section -->
    <section class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-12">Rekomendasi Kost untuk Anda</h2>

            <div class="relative">
                <!-- Tombol Navigasi Kiri -->
                <button id="prev-btn"
                    class="absolute -left-4 top-1/2 -translate-y-1/2 z-30 bg-white rounded-full p-3 shadow-lg hover:bg-gray-200 transition hidden md:flex items-center justify-center">
                    <i class="fas fa-chevron-left text-gray-700"></i>
                </button>

                <!-- Kontainer Slider -->
                <div id="kost-slider"
                    class="flex items-stretch overflow-x-auto snap-x snap-mandatory scroll-smooth scrollbar-hide -mx-4 px-4">
                    <div class="flex flex-nowrap space-x-6">
                        @forelse ($kosts as $kost)
                            {{-- Lebar kartu diperkecil menjadi w-80 (320px) --}}
                            <div class="snap-start w-80 flex-shrink-0">
                                <div
                                    class="bg-white h-full rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition-all duration-300 flex flex-col group">
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $kost->gambar) }}" alt="Foto {{ $kost->nama }}"
                                            class="w-full h-48 object-cover">
                                        <div
                                            class="absolute top-3 right-3 bg-indigo-600 text-white text-xs font-bold px-3 py-1.5 rounded-full">
                                            {{ ucfirst($kost->gender) }}
                                        </div>
                                    </div>

                                    <div class="p-5 flex flex-col flex-grow">
                                        <h3
                                            class="text-lg font-bold text-gray-900 mb-2 truncate group-hover:text-indigo-600 transition">
                                            {{ $kost->nama }}</h3>

                                        <div class="flex items-center text-gray-500 mb-4 text-sm">
                                            <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>
                                            <span class="truncate">{{ $kost->lokasi }}</span>
                                        </div>

                                        <div class="flex-grow"></div> {{-- Spacer --}}

                                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                                            <div>
                                                <p class="text-xs text-gray-500">Mulai dari</p>
                                                <p class="text-lg font-bold text-indigo-600">Rp
                                                    {{ number_format($kost->harga, 0, ',', '.') }}</p>
                                            </div>
                                            <a href="{{ route('kost.show', $kost->id) }}"
                                                class="bg-gray-100 text-gray-800 text-sm font-semibold px-4 py-2 rounded-lg hover:bg-indigo-600 hover:text-white transition-all duration-300">
                                                Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-16 bg-white rounded-2xl shadow-lg w-full">
                                <i class="fas fa-house-user fa-3x text-gray-300 mb-4"></i>
                                <h3 class="text-xl font-semibold text-gray-700">Oops! Kost tidak ditemukan.</h3>
                                <p class="text-gray-500 mt-2">Coba ubah kriteria pencarian Anda.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Tombol Navigasi Kanan -->
                <button id="next-btn"
                    class="absolute -right-4 top-1/2 -translate-y-1/2 z-30 bg-white rounded-full p-3 shadow-lg hover:bg-gray-200 transition hidden md:flex items-center justify-center">
                    <i class="fas fa-chevron-right text-gray-700"></i>
                </button>
            </div>
        </div>
    </section>

    <script>
        // Pastikan DOM sudah dimuat sepenuhnya
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.getElementById('kost-slider');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');

            if (slider && slider.children[0] && slider.children[0].children.length > 0) {
                const firstCard = slider.querySelector('.snap-start');
                // Menghitung lebar scroll berdasarkan lebar kartu pertama + margin
                const scrollAmount = firstCard.offsetWidth + parseInt(window.getComputedStyle(slider.children[0])
                    .gap);

                nextBtn.addEventListener('click', () => {
                    slider.scrollBy({
                        left: scrollAmount,
                        behavior: 'smooth'
                    });
                });

                prevBtn.addEventListener('click', () => {
                    slider.scrollBy({
                        left: -scrollAmount,
                        behavior: 'smooth'
                    });
                });
            }
        });
    </script>
@endsection
