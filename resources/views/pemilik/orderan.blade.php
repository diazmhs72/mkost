@extends('layouts.app')
@section('content')
    <div class="p-4">
        <h2 class="text-xl font-semibold">Orderan Masuk</h2>
        <table class="w-full border mt-4">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2">Nama Kost</th>
                    <th>Penyewa</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr class="border-t">
                        <td class="p-2">{{ $booking->kost->nama }}</td>
                        <td>{{ $booking->penyewa->name }}</td>
                        <td>{{ ucfirst($booking->status) }}</td>
                        <td class="flex gap-2">
                            <form method="POST" action="/orderan/{{ $booking->id }}/setujui">
                                @csrf
                                <button class="bg-green-500 text-white px-2 rounded">Setujui</button>
                            </form>
                            <form method="POST" action="/orderan/{{ $booking->id }}/tolak">
                                @csrf
                                <button class="bg-red-500 text-white px-2 rounded">Tolak</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
