<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'deskripsi',
        'harga',
        'lokasi',
        'gender',
        'jumlah_kamar',
        'gambar',
        'tipe_kamar',
        'kamar_mandi',
        'fasilitas',
        'status',
    ];

    public function pemilik()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
