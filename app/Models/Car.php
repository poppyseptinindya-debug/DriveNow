<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mobil', 'jenis_mobil', 'harga_sewa_per_hari', 'status', 'gambar', 'warna', 'tahun'
    ];

    protected $casts = [
        'harga_sewa_per_hari' => 'integer',
        'tahun' => 'integer',
    ];

    public function scopeTersedia($query)
    {
        return $query->where('status', 'Tersedia');
    }

    public function scopeDisewa($query)
    {
        return $query->where('status', 'Disewakan');
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class, 'car_id');
    }
}
