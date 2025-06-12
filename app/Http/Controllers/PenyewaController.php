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

    public function show($id)
    {
        $kost = Kost::with('user')->findOrFail($id);
        return view('penyewa.show', compact('kost'));
    }

    public function status()
    {
        $bookings = Booking::with('kost')->where('user_id', Auth::id())->get();
        return view('penyewa.status', compact('bookings'));
    }
}
