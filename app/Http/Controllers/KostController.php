<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Kost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;


class KostController extends Controller
{
    /**
     * Menampilkan halaman pencarian kost untuk penyewa.
     */
    public function index(Request $request)
    {
        $kosts = Kost::query()
            // DIKEMBALIKAN: Pencarian sekarang dilakukan pada kolom 'lokasi'
            ->when($request->lokasi, fn($q, $lokasi) => $q->where('lokasi', 'like', "%{$lokasi}%"))
            ->when($request->gender, fn($q) => $q->where('gender', $request->gender))
            ->when($request->harga, fn($q) => $q->where('harga', '<=', $request->harga))
            ->latest()
            ->get();

        return view('penyewa.index', compact('kosts'));
    }

    /**
     * Menampilkan halaman detail sebuah kost.
     */
    public function show(Kost $kost)
    {
        $kost->load('user');
        $hasBooking = Auth::check() ? Booking::where('user_id', Auth::id())->where('kost_id', $kost->id)->exists() : false;
        return view('penyewa.show', compact('kost', 'hasBooking'));
    }

    /**
     * Menampilkan halaman daftar kost milik user yang login.
     */
    public function pemilikIndex()
    {
        $kosts = Kost::where('user_id', Auth::id())->latest()->get();
        return view('pemilik.index', compact('kosts'));
    }

    /**
     * Menampilkan form untuk membuat data kost baru.
     */
    public function create()
    {
        return view('pemilik.create');
    }

    public function store(Request $request)
    {
        // DIKEMBALIKAN: Validasi kembali ke sistem input teks biasa
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'harga' => ['required', 'numeric', 'min:0'],
            'lokasi' => ['required', 'string', 'max:255'], // <-- DIKEMBALIKAN
            'jumlah_kamar' => ['required', 'integer', 'min:1'],
            'gender' => ['required', 'in:pria,wanita,campur'],
            'gambar' => ['required', 'image', 'max:2048'],
            'tipe_kamar' => ['nullable', 'string', 'max:100'],
            'kamar_mandi' => ['nullable', 'string', 'in:Dalam,Luar'],
            'fasilitas' => ['nullable', 'string'],
            'status' => ['required', 'in:Tersedia,Penuh'],
        ]);

        $data['gambar'] = $request->file('gambar')->store('kost', 'public');
        $data['user_id'] = Auth::id();

        Kost::create($data);

        return redirect()->route('pemilik.index')->with('success', 'Data kost berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit data kost.
     */
    public function edit(Kost $kost)
    {
        if ($kost->user_id !== Auth::id()) {
            abort(403);
        }
        return view('pemilik.edit', compact('kost'));
    }

    public function update(Request $request, Kost $kost)
    {
        if ($kost->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk melakukan tindakan ini.');
        }

        // DIKEMBALIKAN: Validasi kembali ke sistem input teks biasa
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'harga' => ['required', 'numeric', 'min:0'],
            'lokasi' => ['required', 'string', 'max:255'], // <-- DIKEMBALIKAN
            'jumlah_kamar' => ['required', 'integer', 'min:1'],
            'gender' => ['required', 'in:pria,wanita,campur'],
            'gambar' => ['nullable', 'image', 'max:2048'],
            'tipe_kamar' => ['nullable', 'string', 'max:100'],
            'kamar_mandi' => ['nullable', 'string', 'in:Dalam,Luar'],
            'fasilitas' => ['nullable', 'string'],
            'status' => ['required', 'in:Tersedia,Penuh'],
        ]);

        if ($request->hasFile('gambar')) {
            if ($kost->gambar) {
                Storage::disk('public')->delete($kost->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('kost', 'public');
        }

        $kost->update($data);

        return redirect()->route('pemilik.index')->with('success', 'Data kost berhasil diperbarui!');
    }

    /**
     * Menghapus data kost dari database.
     */
    public function destroy(Kost $kost)
    {
        if ($kost->user_id !== Auth::id()) {
            abort(403);
        }

        if ($kost->gambar) {
            Storage::disk('public')->delete($kost->gambar);
        }

        $kost->delete();

        return redirect()->route('pemilik.index')->with('success', 'Data kost berhasil dihapus.');
    }
}
