@extends('layouts.app')
@section('content')
    <style>
        .hero-bg {
            background: linear-gradient(135deg, #e3e3e3 0%, #959595 100%);
        }

        .card-hover:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }


        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>



    <section>
        <!-- Hero Content -->
        <div class="text-center text-white">

            <!-- House Illustrations -->
            <div class="mx-auto mb-8 place-items-center">
                <img src="{{ asset('img/bg-lp.png') }}" alt="" width="1080">
            </div>

            <p class="text-2xl font-medium mb-12 text-black">
                ~ cari kost mudah dan cepat ~
            </p>

            <!-- Filter Section -->
            <div class="max-w-7xl mx-auto mb-8 flex justify-center">
                <form action="{{ route('index') }}" method="GET" class="flex flex-wrap gap-3 items-end">
                    <div>
                        <input name="lokasi" placeholder="Cari lokasi..." value="{{ request('lokasi') }}"
                            class="w-48 px-4 py-2 rounded-lg bg-white text-gray-700 border shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none" />
                    </div>

                    <div>
                        <select name="gender"
                            class="w-40 px-4 py-2 rounded-lg bg-white text-gray-700 border shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none">
                            <option value="">Semua Gender</option>
                            <option value="pria" {{ request('gender') == 'pria' ? 'selected' : '' }}>Pria</option>
                            <option value="wanita" {{ request('gender') == 'wanita' ? 'selected' : '' }}>Wanita</option>
                            <option value="campur" {{ request('gender') == 'campur' ? 'selected' : '' }}>Campur</option>
                        </select>
                    </div>

                    <div>
                        <input name="harga" type="number" placeholder="Max Harga" value="{{ request('harga') }}"
                            class="w-40 px-4 py-2 rounded-lg bg-white text-gray-700 border shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none" />
                    </div>

                    <div>
                        <button
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition shadow">
                            <i class="fas fa-search mr-2"></i>Cari
                        </button>
                    </div>
                </form>
            </div>

        </div>
        </div>
    </section>

    <!-- Kost Cards Section -->
    <section class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">


                <div class="flex-1 mx-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach ($kosts as $kost)
                            <div class="border rounded p-4 shadow">
                                <img src="{{ asset('storage/' . $kost->gambar) }}" class="w-full h-40 object-cover mb-2">
                                <h2 class="text-lg font-semibold">{{ $kost->nama }}</h2>
                                <p>{{ $kost->lokasi }}</p>
                                <p>Rp {{ number_format($kost->harga) }}</p>
                                <p>Khusus {{ $kost->gender }}</p>
                                <a href="/kost/{{ $kost->id }}" class="text-blue-600">Lihat Detail</a>
                            </div>
                        @endforeach
                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection
