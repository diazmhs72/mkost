<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Mengubah tipe kolom 'status' menjadi ENUM
            // Ini akan memastikan hanya nilai-nilai ini yang bisa masuk
            // dan ukurannya sudah pasti cukup.
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Kode untuk mengembalikan perubahan jika diperlukan (opsional)
            // Anda mungkin perlu menyesuaikan tipe data di sini jika aslinya bukan string
            $table->string('status', 20)->change();
        });
    }
};
