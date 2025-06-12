@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4 md:p-8">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Data Kost</h1>

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

            <form method="POST" action="{{ route('kost.update', $kost) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT') {{-- Method untuk update --}}

                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Kost</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $kost->nama) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                </div>

                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Singkat</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        required>{{ old('deskripsi', $kost->deskripsi) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="harga" class="block text-sm font-medium text-gray-700">Harga per Bulan</label>
                        <input type="number" id="harga" name="harga" value="{{ old('harga', $kost->harga) }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>
                    <div>
                        <label for="jumlah_kamar" class="block text-sm font-medium text-gray-700">Jumlah Kamar</label>
                        <input type="number" id="jumlah_kamar" name="jumlah_kamar"
                            value="{{ old('jumlah_kamar', $kost->jumlah_kamar) }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>
                </div>

                <div>
                    <label for="lokasi" class="block text-sm font-medium text-gray-700">Alamat / Lokasi</label>
                    <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $kost->lokasi) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                </div>

                <hr>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="tipe_kamar" class="block text-sm font-medium text-gray-700">Tipe Kamar</label>
                        <input type="text" id="tipe_kamar" name="tipe_kamar"
                            value="{{ old('tipe_kamar', $kost->tipe_kamar) }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="kamar_mandi" class="block text-sm font-medium text-gray-700">Kamar Mandi</label>
                        <select id="kamar_mandi" name="kamar_mandi"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="Dalam" @selected(old('kamar_mandi', $kost->kamar_mandi) == 'Dalam')>Dalam</option>
                            <option value="Luar" @selected(old('kamar_mandi', $kost->kamar_mandi) == 'Luar')>Luar</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="fasilitas" class="block text-sm font-medium text-gray-700">Fasilitas</label>
                    <textarea id="fasilitas" name="fasilitas" rows="3"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('fasilitas', $kost->fasilitas) }}</textarea>
                </div>

                <hr>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700">Dikhususkan Untuk</label>
                        <select id="gender" name="gender"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                            <option value="pria" @selected(old('gender', $kost->gender) == 'pria')>Pria</option>
                            <option value="wanita" @selected(old('gender', $kost->gender) == 'wanita')>Wanita</option>
                            <option value="campur" @selected(old('gender', $kost->gender) == 'campur')>Campur</option>
                        </select>
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status Ketersediaan</label>
                        <select id="status" name="status"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                            <option value="Tersedia" @selected(old('status', $kost->status) == 'Tersedia')>Tersedia</option>
                            <option value="Penuh" @selected(old('status', $kost->status) == 'Penuh')>Penuh</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="gambar" class="block text-sm font-medium text-gray-700">Ganti Gambar Utama
                        (Opsional)</label>
                    <img src="{{ asset('storage/' . $kost->gambar) }}" alt="Gambar saat ini"
                        class="my-2 w-40 h-auto rounded-md">
                    <input type="file" id="gambar" name="gambar"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-indigo-600 text-white px-4 py-3 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
