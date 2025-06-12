<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Pastikan Storage di-import

class KostController extends Controller
{
    public function create()
    {
        return view('pemilik.create');
    }

    public function edit(Kost $kost)
    {
        // Pengecekan sederhana: Pastikan user yang login adalah pemilik kost
        if ($kost->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return view('pemilik.edit', compact('kost'));
    }

    public function update(Request $request, Kost $kost)
    {
        // Pengecekan sederhana: Pastikan user yang login adalah pemilik kost
        if ($kost->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk melakukan tindakan ini.');
        }

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'lokasi' => 'required|string|max:255',
            'jumlah_kamar' => 'required|integer|min:1',
            'gender' => 'required|in:pria,wanita,campur',
            'gambar' => 'nullable|image|max:2048',
            'tipe_kamar' => 'nullable|string|max:100',
            'kamar_mandi' => 'nullable|string|in:Dalam,Luar',
            'fasilitas' => 'nullable|string',
            'status' => 'required|in:Tersedia,Penuh',
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


    public function destroy(Kost $kost)
    {
        // Pengecekan sederhana: Pastikan user yang login adalah pemilik kost
        if ($kost->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk melakukan tindakan ini.');
        }

        if ($kost->gambar) {
            Storage::disk('public')->delete($kost->gambar);
        }

        $kost->delete();

        return redirect()->route('pemilik.index')->with('success', 'Data kost berhasil dihapus.');
    }



    public function index(Request $request)
    {
        $kosts = Kost::query()
            ->when($request->gender, fn($q) => $q->where('gender', $request->gender))
            ->when($request->lokasi, fn($q) => $q->where('lokasi', 'like', "%{$request->lokasi}%"))
            ->when($request->harga, fn($q) => $q->where('harga', '<=', $request->harga))
            ->get();

        return view('penyewa.index', compact('kosts'));
    }

    public function show(Kost $kost)
    {
        $kost->load('user');
        return view('penyewa.show', compact('kost'));
    }



    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'lokasi' => 'required|string|max:255',
            'jumlah_kamar' => 'required|integer|min:1',
            'gender' => 'required|in:pria,wanita,campur',
            'gambar' => 'required|image|max:2048',
            'tipe_kamar' => 'nullable|string|max:100',
            'kamar_mandi' => 'nullable|string|in:Dalam,Luar',
            'fasilitas' => 'nullable|string',
            'status' => 'required|in:Tersedia,Penuh',
        ]);

        $data['gambar'] = $request->file('gambar')->store('kost', 'public');
        $data['user_id'] = Auth::id();

        Kost::create($data);

        return redirect()->route('pemilik.index')->with('success', 'Data kost berhasil ditambahkan!');
    }

    public function pemilikIndex()
    {
        $kosts = Kost::where('user_id', Auth::id())->latest()->get();
        return view('pemilik.index', compact('kosts'));
    }
}
