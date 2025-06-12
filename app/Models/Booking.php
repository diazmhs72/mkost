<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'kost_id',
        'user_id',
        'status',
        'bukti_pembayaran'
    ];

    public function kost()
    {
        return $this->belongsTo(Kost::class);
    }

    public function penyewa()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
