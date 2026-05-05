<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'customer_name',
        'rental_date',
        'days',
        'total_price'
    ];

    protected $casts = [
        'rental_date' => 'date',
        'total_price' => 'decimal:2'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
}
