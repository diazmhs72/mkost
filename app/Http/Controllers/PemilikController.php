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
        $bookings = Booking::with('kost', 'penyewa')
            ->whereHas('kost', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->get();

        return view('pemilik.orderan', compact('bookings'));
    }
}
