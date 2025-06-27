<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
{
    use HandlesAuthorization;

    /**
     * Menentukan apakah pengguna dapat memperbarui data booking.
     * Ini akan dipanggil saat menyetujui atau menolak booking.
     *
     * @param  \App\Models\User  $user    // Pengguna yang sedang login (pemilik)
     * @param  \App\Models\Booking  $booking // Booking yang akan di-update
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Booking $booking)
    {
        // Izinkan aksi jika ID pengguna yang login sama dengan
        // ID pemilik (user_id) dari properti kost yang dibooking.
        return $user->id === $booking->kost->user_id;
    }
}
