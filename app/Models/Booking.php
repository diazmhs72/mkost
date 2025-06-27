<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'kost_id',
        'status',
        'tanggal_mulai',
        'approved_at',
    ];

    /**
     * Mendefinisikan relasi "belongsTo" ke model User.
     * Ini akan menghubungkan setiap booking dengan penyewanya.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Mendefinisikan relasi "belongsTo" ke model Kost.
     * Ini akan menghubungkan setiap booking dengan kost yang dipesan.
     */
    public function kost()
    {
        return $this->belongsTo(Kost::class, 'kost_id');
    }
}
