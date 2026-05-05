<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'jenis', 'harga', 'status', 'gambar'
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    public function scopeTersedia($query)
    {
        return $query->where('status', 'Tersedia');
    }

    public function scopeDisewa($query)
    {
        return $query->where('status', 'Disewa');
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class, 'car_id');
    }
}
