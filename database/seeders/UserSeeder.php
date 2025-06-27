<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::create([
            'name' => 'Agus Pemilik',
            'email' => 'pemilik@example.com',
            'password' => Hash::make('password'),
            'role' => 'pemilik',
        ]);

        User::create([
            'name' => 'Budi Pemilik',
            'email' => 'pemilik2@example.com',
            'password' => Hash::make('password'),
            'role' => 'pemilik',
        ]);

        User::create([
            'name' => 'Citra Penyewa',
            'email' => 'penyewa@example.com',
            'password' => Hash::make('password'),
            'role' => 'penyewa',
        ]);

        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }
}
