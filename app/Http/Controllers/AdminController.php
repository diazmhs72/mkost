<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Menampilkan halaman manajemen user dengan paginasi.
     */
    public function index()
    {
        // Gunakan paginate untuk efisiensi dan urutkan berdasarkan user terbaru
        $users = User::latest()->paginate(10);
        return view('admin.index', compact('users'));
    }

    /**
     * Memperbarui data user menggunakan Route Model Binding.
     */
    public function update(Request $request, User $user) // Menggunakan Route Model Binding
    {
        // Validasi input untuk keamanan dan integritas data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id), // Pastikan email unik, kecuali untuk user ini sendiri
            ],
            'role' => 'required|in:penyewa,pemilik,admin', // Pastikan role yang diinput valid
        ]);

        // Update data user
        $user->update($validatedData);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.users')->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Menghapus data user menggunakan Route Model Binding.
     */
    public function destroy(User $user) // Menggunakan Route Model Binding
    {
        // Hapus user
        $user->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus.');
    }
}
