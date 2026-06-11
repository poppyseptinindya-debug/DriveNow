<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'user_id',
        'tanggal_sewa',
        'lama_sewa',
        'total_harga',
        'status_penyewaan',
        'metode_pembayaran',
        'bukti_transfer',
        'rating',
        'review'
    ];

    protected $casts = [
        'tanggal_sewa' => 'date',
        'lama_sewa' => 'integer',
        'total_harga' => 'integer',
        'rating' => 'integer'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
