@extends('layouts.app')

@section('content')

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
            xintegrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <main class="bg-gray-100 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Status Booking Saya</h1>

            @if (session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if (session('warning'))
                <div class="mb-6 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg" role="alert">
                    <p>{{ session('warning') }}</p>
                </div>
            @endif

            <div class="space-y-6">
                @forelse ($bookings as $booking)
                    <div
                        class="bg-white rounded-2xl shadow-lg p-6 flex flex-col sm:flex-row items-start sm:items-center gap-6">
                        <img src="{{ asset('storage/' . $booking->kost->gambar) }}" alt="Foto {{ $booking->kost->nama }}"
                            class="w-full sm:w-32 h-32 object-cover rounded-lg">

                        <div class="flex-grow">
                            <h2 class="text-xl font-bold text-gray-800">{{ $booking->kost->nama }}</h2>
                            <p class="text-sm text-gray-500">{{ $booking->kost->lokasi }}</p>
                            <div class="mt-3">
                                @if ($booking->status == 'pending')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-2"></i> Menunggu Konfirmasi
                                    </span>
                                @elseif ($booking->status == 'disetujui')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-2"></i> Disetujui
                                    </span>
                                @elseif ($booking->status == 'ditolak')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-2"></i> Ditolak
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Notifikasi Pembayaran --}}
                    @if ($booking->status == 'disetujui')
                        @php
                            // Batas waktu pembayaran
                            $paymentDeadline = \Carbon\Carbon::parse($booking->approved_at)->addDays(3);
                        @endphp
                        <div
                            class="-mt-4 mx-2 p-4 bg-indigo-50 border-2 border-dashed border-indigo-200 rounded-b-2xl text-center">
                            <p class="font-semibold text-indigo-800">
                                <i class="fas fa-bell mr-2"></i> Silakan lakukan pembayaran langsung di lokasi sebelum
                                tanggal
                                <span class="font-bold">{{ $paymentDeadline->format('d F Y') }}</span>.
                            </p>
                        </div>
                    @endif
                @empty
                    <div class="text-center py-16 bg-white rounded-2xl shadow-lg">
                        <i class="fas fa-folder-open fa-3x text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-700">Anda belum memiliki riwayat booking.</h3>
                        <p class="text-gray-500 mt-2">Ayo cari kost impian Anda sekarang!</p>
                        <a href="{{ route('index') }}"
                            class="mt-4 inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
                            Cari Kost
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
@endsection
