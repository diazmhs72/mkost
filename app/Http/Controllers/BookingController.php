<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Kost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['kost_id' => 'required|exists:kosts,id']);

        Booking::create([
            'kost_id' => $request->kost_id,
            'user_id' => Auth::id(),
            'status' => 'pending',
        ]);

        return redirect('/status-booking');
    }

    public function status()
    {
        $bookings = Booking::where('user_id', Auth::id())->with('kost')->get();
        return view('penyewa.status', compact('bookings'));
    }

    public function orderan()
    {
        $bookings = Booking::whereHas('kost', function ($q) {
            $q->where('user_id', Auth::id());
        })->with('kost', 'penyewa')->get();

        return view('pemilik.orderan', compact('bookings'));
    }

    public function setujui(Booking $booking)
    {
        $booking->update(['status' => 'disetujui']);
        return back();
    }

    public function tolak(Booking $booking)
    {
        $booking->update(['status' => 'ditolak']);
        return back();
    }
}
