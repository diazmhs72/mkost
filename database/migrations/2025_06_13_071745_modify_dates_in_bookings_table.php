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
            // Mengubah kolom 'tanggal_mulai' yang sudah ada agar boleh null
            $table->date('tanggal_mulai')->nullable()->change();

            // MENAMBAHKAN kolom 'approved_at' yang baru karena belum ada
            $table->timestamp('approved_at')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Mengembalikan perubahan untuk tanggal_mulai
            $table->date('tanggal_mulai')->nullable(false)->change();

            // Menghapus kolom approved_at jika migrasi di-rollback
            $table->dropColumn('approved_at');
        });
    }
};
