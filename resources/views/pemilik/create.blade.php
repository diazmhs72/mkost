@extends('layouts.app')

@section('content')
    <main class="flex-grow flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-12 w-full max-w-5xl">
            <h1 class="text-4xl font-extrabold text-gray-800 text-center mb-10">Tambah Kost</h1>

            <!-- Menampilkan Error Validasi -->
            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Oops! Ada yang salah:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('kost.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Kost</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                        placeholder="Contoh: Kost Sigma"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                </div>
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Singkat</label>
                    <textarea id="deskripsi" name="deskripsi" placeholder="Jelaskan tentang kost Anda" rows="4"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>{{ old('deskripsi') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="harga" class="block text-sm font-medium text-gray-700">Harga per Bulan</label>
                        <input type="number" id="harga" name="harga" value="{{ old('harga') }}"
                            placeholder="Contoh: 100000"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <label for="jumlah_kamar" class="block text-sm font-medium text-gray-700">Jumlah Kamar
                            Tersedia</label>
                        <input type="number" id="jumlah_kamar" name="jumlah_kamar" value="{{ old('jumlah_kamar') }}"
                            placeholder="Contoh: 10"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                </div>

                <div>
                    <label for="lokasi" class="block text-sm font-medium text-gray-700">Alamat / Lokasi</label>
                    <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}"
                        placeholder="Masukkan alamat lengkap atau nama jalan"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                </div>

                <hr>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="tipe_kamar" class="block text-sm font-medium text-gray-700">Tipe Kamar</label>
                        <input type="text" id="tipe_kamar" name="tipe_kamar"
                            value="{{ old('tipe_kamar', 'Single Bed') }}" placeholder="Contoh: Single Bed"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="kamar_mandi" class="block text-sm font-medium text-gray-700">Kamar Mandi</label>
                        <select id="kamar_mandi" name="kamar_mandi"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="Dalam" @selected(old('kamar_mandi') == 'Dalam')>Dalam</option>
                            <option value="Luar" @selected(old('kamar_mandi') == 'Luar')>Luar</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="fasilitas" class="block text-sm font-medium text-gray-700">Fasilitas</label>
                    <textarea id="fasilitas" name="fasilitas" placeholder="Contoh: Wi-Fi, AC, Lemari, CCTV" rows="3"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('fasilitas') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Pisahkan setiap fasilitas dengan koma.</p>
                </div>

                <hr>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700">Dikhususkan Untuk</label>
                        <select id="gender" name="gender"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                            <option value="">Pilih Kategori</option>
                            <option value="pria" @selected(old('gender') == 'pria')>Pria</option>
                            <option value="wanita" @selected(old('gender') == 'wanita')>Wanita</option>
                            <option value="campur" @selected(old('gender') == 'campur')>Campur</option>
                        </select>
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status Ketersediaan</label>
                        <select id="status" name="status"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                            <option value="Tersedia" @selected(old('status') == 'Tersedia')>Tersedia</option>
                            <option value="Penuh" @selected(old('status') == 'Penuh')>Penuh</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar Utama Kost</label>
                    <input type="file" id="gambar" name="gambar"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                        required>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-indigo-600 text-white px-4 py-3 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Simpan Data Kost
                    </button>
                </div>
            </form>
        </div>
        </div>
    @endsection
