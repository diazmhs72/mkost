<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class PemilikController extends Controller
{
    public function index()
    {
        $kosts = Kost::where('user_id', Auth::id())->get();
        return view('pemilik.index', compact('kosts'));
    }

    public function create()
    {
        return view('pemilik.create');
    }

    public function orderan()
    {
        // Ambil ID semua kost milik user yang login
        $kostIds = Auth::user()->kosts->pluck('id');

        // Ambil semua booking untuk kost-kost tersebut
        $bookings = Booking::whereIn('kost_id', $kostIds)
            ->with(['user', 'kost']) // Eager load relasi user dan kost
            ->latest()
            ->get();

        return view('pemilik.orderan', compact('bookings'));
    }
}
