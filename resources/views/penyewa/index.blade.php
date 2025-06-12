@extends('layouts.app')
@section('content')
    <div class="p-4">
        <form action="{{ route('index') }}" method="GET" class="mb-4 flex flex-wrap justify-center gap-2">
            <input name="lokasi" placeholder="Cari lokasi..." value="{{ request('lokasi') }}" class="border rounded p-2" />
            <select name="gender" class="border rounded p-2">
                <option value="">Semua Gender</option>
                <option value="pria" {{ request('gender') == 'pria' ? 'selected' : '' }}>Pria</option>
                <option value="wanita" {{ request('gender') == 'wanita' ? 'selected' : '' }}>Wanita</option>
                <option value="campur" {{ request('gender') == 'campur' ? 'selected' : '' }}>Campur</option>
            </select>
            <input name="harga" type="number" placeholder="Max Harga" value="{{ request('harga') }}"
                class="border rounded p-2" />
            <button class="bg-blue-500 text-white px-4 rounded">Filter</button>
        </form>


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
@endsection
