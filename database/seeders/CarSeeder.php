<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $cars = [
            [
                'nama' => 'Toyota Avanza',
                'jenis' => 'MPV',
                'harga' => 350000,
                'status' => 'Tersedia',
                'gambar' => 'avanza.jpg'
            ],
            [
                'nama' => 'Honda Brio',
                'jenis' => 'City Car',
                'harga' => 250000,
                'status' => 'Tersedia',
                'gambar' => 'brio.jpg'
            ],
            [
                'nama' => 'Toyota Calya',
                'jenis' => 'MPV',
                'harga' => 280000,
                'status' => 'Disewa',
                'gambar' => 'calya.jpg'
            ],
            [
                'nama' => 'Honda Civic',
                'jenis' => 'Sedan',
                'harga' => 500000,
                'status' => 'Tersedia',
                'gambar' => 'civic.jpg'
            ],
            [
                'nama' => 'Toyota Fortuner',
                'jenis' => 'SUV',
                'harga' => 800000,
                'status' => 'Tersedia',
                'gambar' => 'fortuner.jpg'
            ],
            [
                'nama' => 'Mitsubishi Pajero',
                'jenis' => 'SUV',
                'harga' => 850000,
                'status' => 'Disewa',
                'gambar' => 'pajero.jpg'
            ],
            [
                'nama' => 'Toyota Xenia',
                'jenis' => 'MPV',
                'harga' => 300000,
                'status' => 'Tersedia',
                'gambar' => 'xenia.jpg'
            ],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}
