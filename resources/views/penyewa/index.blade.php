@extends('layouts.app')

@section('content')
    {{-- Head section untuk menambahkan Font Awesome untuk ikon --}}

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
            xintegrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <main class="bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filter Section -->
            <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 mb-12">
                <form action="{{ route('index') }}" method="GET"
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 items-end">
                    {{-- Lokasi --}}
                    <div class="sm:col-span-2 lg:col-span-2">
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
                            <i class="fas fa-filter mr-2"></i>Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Kost Grid Section -->
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-12">Hasil Pencarian Kost</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($kosts as $kost)
                    <div
                        class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition-all duration-300 flex flex-col group">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $kost->gambar) }}" alt="Foto {{ $kost->nama }}"
                                class="w-full h-56 object-cover">
                            <div
                                class="absolute top-4 right-4 bg-indigo-600 text-white text-xs font-bold px-3 py-1.5 rounded-full">
                                {{ ucfirst($kost->gender) }}
                            </div>
                        </div>

                        <div class="p-6 flex flex-col flex-grow">
                            <h3
                                class="text-xl font-bold text-gray-900 mb-2 truncate group-hover:text-indigo-600 transition">
                                {{ $kost->nama }}</h3>

                            <div class="flex items-center text-gray-500 mb-4 text-sm">
                                <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>
                                <span>{{ $kost->lokasi }}</span>
                            </div>

                            <div class="flex-grow"></div> {{-- Spacer --}}

                            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                                <div>
                                    <p class="text-sm text-gray-500">Mulai dari</p>
                                    <p class="text-xl font-bold text-indigo-600">Rp
                                        {{ number_format($kost->harga, 0, ',', '.') }}<span
                                            class="text-sm font-normal text-gray-500">/bln</span></p>
                                </div>
                                <a href="{{ route('kost.show', $kost->id) }}"
                                    class="bg-gray-100 text-gray-800 font-semibold px-5 py-2.5 rounded-xl hover:bg-indigo-600 hover:text-white transition-all duration-300">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 bg-white rounded-2xl shadow-lg">
                        <i class="fas fa-house-user fa-3x text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-700">Oops! Kost tidak ditemukan.</h3>
                        <p class="text-gray-500 mt-2">Coba gunakan filter lain atau periksa kembali kata kunci Anda.</p>
                    </div>
                @endforelse
            </div>

        </div>
        </section>
    @endsection
