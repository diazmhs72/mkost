<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Kost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Tambahkan ini

class BookingController extends Controller
{
    use AuthorizesRequests; // Dan tambahkan ini

    /**
     * Menyimpan permintaan booking baru dari penyewa.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kost_id' => 'required|exists:kosts,id',
        ]);

        $userId = Auth::id();
        $kostId = $request->kost_id;

        // Cek apakah user sudah pernah booking kost ini sebelumnya
        $existingBooking = Booking::where('user_id', $userId)
            ->where('kost_id', $kostId)
            ->first();

        if ($existingBooking) {
            return redirect()->route('penyewa.status')->with('warning', 'Anda sudah pernah memesan kost ini. Silakan cek status pesanan Anda.');
        }

        // Buat booking baru dengan status 'pending'
        Booking::create([
            'user_id' => $userId,
            'kost_id' => $kostId,
            'status' => 'pending',
        ]);

        return redirect()->route('penyewa.status')->with('success', 'Booking berhasil diajukan! Silakan tunggu konfirmasi dari pemilik.');
    }

    /**
     * Menyetujui booking oleh pemilik.
     */
    public function setujui(Booking $booking)
    {
        // Otorisasi: pastikan yang menyetujui adalah pemilik kost terkait
        $this->authorize('update', $booking);

        $booking->update([
            'status' => 'disetujui',
            'approved_at' => now(), // Catat waktu persetujuan
        ]);

        return redirect()->back()->with('success', 'Booking telah disetujui.');
    }

    /**
     * Menolak booking oleh pemilik.
     */
    public function tolak(Booking $booking)
    {
        // Otorisasi: pastikan yang menolak adalah pemilik kost terkait
        $this->authorize('update', $booking);

        $booking->update(['status' => 'ditolak']);

        return redirect()->back()->with('success', 'Booking telah ditolak.');
    }
}
