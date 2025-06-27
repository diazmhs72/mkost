<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class PenyewaController extends Controller
{
    public function index()
    {
        $kosts = Kost::latest()->get();
        return view('penyewa.index', compact('kosts'));
    }

    public function home()
    {
        $kosts = Kost::latest()->get();
        return view('home', compact('kosts'));
    }

    public function status()
    {
        // Ambil booking milik user yang login, urutkan dari yang terbaru
        $bookings = Booking::where('user_id', Auth::id())
            ->with('kost') // Eager load relasi kost
            ->latest()
            ->get();

        return view('penyewa.status', compact('bookings'));
    }

    public function show($id)
    {
        $kost = Kost::with('user')->findOrFail($id);
        // Cek apakah user sudah punya booking untuk kost ini
        $hasBooking = Booking::where('user_id', Auth::id())
            ->where('kost_id', $id)
            ->exists();

        return view('penyewa.show', compact('kost', 'hasBooking'));
    }
}
