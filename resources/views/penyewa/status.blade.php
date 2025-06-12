@extends('layouts.app')
@section('content')
    <div class="p-4">
        <h2 class="text-xl font-semibold mb-4">Status Booking</h2>
        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2">Nama Kost</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr class="border-t">
                        <td class="p-2">{{ $booking->kost->nama }}</td>
                        <td>{{ ucfirst($booking->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
