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
        Schema::table('kosts', function (Blueprint $table) {
            // Menambahkan kolom baru setelah kolom 'jumlah_kamar'
            $table->string('tipe_kamar')->nullable()->after('jumlah_kamar');
            $table->string('kamar_mandi')->nullable()->after('tipe_kamar');
            $table->text('fasilitas')->nullable()->after('kamar_mandi');
            $table->string('status')->default('Tersedia')->after('fasilitas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kosts', function (Blueprint $table) {
            $table->dropColumn(['tipe_kamar', 'kamar_mandi', 'fasilitas', 'status']);
        });
    }
};
