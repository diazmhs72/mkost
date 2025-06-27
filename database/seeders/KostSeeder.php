<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kost;

class KostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Temukan beberapa user pemilik untuk dijadikan pemilik kost
        $pemilik1 = User::where('role', 'pemilik')->first();
        $pemilik2 = User::where('role', 'pemilik')->skip(1)->first();

        if (!$pemilik1) {
            $this->command->info('Tidak ditemukan user dengan peran "pemilik". Seeder Kost dibatalkan.');
            return;
        }

        $kosts = [
            [
                'user_id' => $pemilik1->id,
                'nama' => 'Kost Melati',
                'deskripsi' => 'Kost nyaman dengan fasilitas lengkap di pusat kota. Dekat dengan universitas dan area perkantoran. Keamanan 24 jam.',
                'harga' => 1500000,
                'lokasi' => 'Jl. Diponegoro No. 22, Bandung',
                'gender' => 'campur',
                'jumlah_kamar' => 15,
                'gambar' => 'kost/kost1.jpeg',
                'tipe_kamar' => 'Single Bed + AC',
                'kamar_mandi' => 'Dalam',
                'fasilitas' => 'AC, WiFi, Lemari, Meja Belajar, Parkir Motor',
                'status' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $pemilik1->id,
                'nama' => 'Kost Kecil',
                'deskripsi' => 'Kost khusus putri yang aman dan bersih. Lingkungan tenang dan asri, cocok untuk belajar dan istirahat.',
                'harga' => 850000,
                'lokasi' => 'Jl. Kaliurang KM 5, Yogyakarta',
                'gender' => 'wanita',
                'jumlah_kamar' => 10,
                'gambar' => 'kost/kost2.jpg',
                'tipe_kamar' => 'Single Bed',
                'kamar_mandi' => 'Luar',
                'fasilitas' => 'WiFi, Lemari, Dapur Umum, Ruang Tamu',
                'status' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $pemilik2->id ?? $pemilik1->id,
                'nama' => 'Kost Anggrek Putra',
                'deskripsi' => 'Kost modern khusus putra dengan fasilitas premium. Lokasi strategis dekat pusat bisnis dan mall.',
                'harga' => 2200000,
                'lokasi' => 'Jl. Jenderal Sudirman Kav. 52-53, Jakarta Selatan',
                'gender' => 'pria',
                'jumlah_kamar' => 8,
                'gambar' => 'kost/kost3.jpeg',
                'tipe_kamar' => 'Queen Bed + AC + TV Kabel',
                'kamar_mandi' => 'Dalam',
                'fasilitas' => 'AC, WiFi, TV, Water Heater, Lemari, Meja, Parkir Mobil',
                'status' => 'Penuh',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $pemilik2->id ?? $pemilik1->id,
                'nama' => 'Kost Yolanda',
                'deskripsi' => 'Kost modern khusus putra dengan fasilitas premium. Lokasi strategis dekat pusat bisnis dan mall.',
                'harga' => 2200000,
                'lokasi' => 'Blater, Purbalingga',
                'gender' => 'pria',
                'jumlah_kamar' => 8,
                'gambar' => 'kost/kost5.jpeg',
                'tipe_kamar' => 'Queen Bed + AC + TV Kabel',
                'kamar_mandi' => 'Dalam',
                'fasilitas' => 'AC, WiFi, TV, Water Heater, Lemari, Meja, Parkir Mobil',
                'status' => 'Penuh',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $pemilik2->id ?? $pemilik1->id,
                'nama' => 'Kost Racing',
                'deskripsi' => 'Kost modern khusus putra dengan fasilitas premium. Lokasi strategis dekat pusat bisnis dan mall.',
                'harga' => 2200000,
                'lokasi' => 'Kalimanah, Purbalingga',
                'gender' => 'pria',
                'jumlah_kamar' => 8,
                'gambar' => 'kost/kost4.jpeg',
                'tipe_kamar' => 'Queen Bed + AC + TV Kabel',
                'kamar_mandi' => 'Dalam',
                'fasilitas' => 'AC, WiFi, TV, Water Heater, Lemari, Meja, Parkir Mobil',
                'status' => 'Penuh',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Kost::insert($kosts);
    }
}
