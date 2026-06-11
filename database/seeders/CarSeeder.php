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
                'nama_mobil' => 'Toyota Avanza',
                'jenis_mobil' => 'MPV',
                'harga_sewa_per_hari' => 350000,
                'status' => 'Tersedia',
                'warna' => 'Hitam',
                'tahun' => 2022,
                'gambar' => 'avanza_hitam.png'
            ],
            [
                'nama_mobil' => 'Toyota Avanza',
                'jenis_mobil' => 'MPV',
                'harga_sewa_per_hari' => 360000,
                'status' => 'Tersedia',
                'warna' => 'Silver',
                'tahun' => 2023,
                'gambar' => 'avanza_silver.png'
            ],
            [
                'nama_mobil' => 'Honda Brio',
                'jenis_mobil' => 'City Car',
                'harga_sewa_per_hari' => 250000,
                'status' => 'Tersedia',
                'warna' => 'Merah',
                'tahun' => 2021,
                'gambar' => 'brio_merah.png'
            ],
            [
                'nama_mobil' => 'Honda Brio',
                'jenis_mobil' => 'City Car',
                'harga_sewa_per_hari' => 260000,
                'status' => 'Tersedia',
                'warna' => 'Kuning',
                'tahun' => 2022,
                'gambar' => 'brio_kuning.png'
            ],
            [
                'nama_mobil' => 'Toyota Calya',
                'jenis_mobil' => 'MPV',
                'harga_sewa_per_hari' => 280000,
                'status' => 'Tersedia',
                'warna' => 'Putih',
                'tahun' => 2020,
                'gambar' => 'calya.jpg'
            ],
            [
                'nama_mobil' => 'Honda Civic',
                'jenis_mobil' => 'Sedan',
                'harga_sewa_per_hari' => 500000,
                'status' => 'Tersedia',
                'warna' => 'Merah',
                'tahun' => 2022,
                'gambar' => 'civic_merah.png'
            ],
            [
                'nama_mobil' => 'Honda Civic',
                'jenis_mobil' => 'Sedan',
                'harga_sewa_per_hari' => 550000,
                'status' => 'Tersedia',
                'warna' => 'Hitam',
                'tahun' => 2023,
                'gambar' => 'civic_hitam.png'
            ],
            [
                'nama_mobil' => 'Toyota Fortuner',
                'jenis_mobil' => 'SUV',
                'harga_sewa_per_hari' => 800000,
                'status' => 'Tersedia',
                'warna' => 'Hitam',
                'tahun' => 2022,
                'gambar' => 'fortuner_hitam.png'
            ],
            [
                'nama_mobil' => 'Toyota Fortuner',
                'jenis_mobil' => 'SUV',
                'harga_sewa_per_hari' => 850000,
                'status' => 'Tersedia',
                'warna' => 'Putih',
                'tahun' => 2023,
                'gambar' => 'fortuner_putih.png'
            ],
            [
                'nama_mobil' => 'Mitsubishi Pajero',
                'jenis_mobil' => 'SUV',
                'harga_sewa_per_hari' => 850000,
                'status' => 'Tersedia',
                'warna' => 'Abu-abu',
                'tahun' => 2022,
                'gambar' => 'pajero.jpg'
            ],
            [
                'nama_mobil' => 'Daihatsu Xenia',
                'jenis_mobil' => 'MPV',
                'harga_sewa_per_hari' => 300000,
                'status' => 'Tersedia',
                'warna' => 'Putih',
                'tahun' => 2021,
                'gambar' => 'xenia.jpg'
            ],
            [
                'nama_mobil' => 'Toyota Alphard',
                'jenis_mobil' => 'MPV',
                'harga_sewa_per_hari' => 1500000,
                'status' => 'Tersedia',
                'warna' => 'Hitam',
                'tahun' => 2023,
                'gambar' => 'calya.jpg'
            ],
            [
                'nama_mobil' => 'Hyundai Ioniq 5',
                'jenis_mobil' => 'City Car',
                'harga_sewa_per_hari' => 900000,
                'status' => 'Tersedia',
                'warna' => 'Silver Matte',
                'tahun' => 2022,
                'gambar' => 'brio.jpg'
            ],
            [
                'nama_mobil' => 'Honda HR-V',
                'jenis_mobil' => 'SUV',
                'harga_sewa_per_hari' => 450000,
                'status' => 'Tersedia',
                'warna' => 'Hitam',
                'tahun' => 2022,
                'gambar' => 'fortuner_hitam.png'
            ],
            [
                'nama_mobil' => 'Honda HR-V',
                'jenis_mobil' => 'SUV',
                'harga_sewa_per_hari' => 470000,
                'status' => 'Tersedia',
                'warna' => 'Putih',
                'tahun' => 2023,
                'gambar' => 'fortuner_putih.png'
            ],
            [
                'nama_mobil' => 'Mitsubishi Xpander',
                'jenis_mobil' => 'MPV',
                'harga_sewa_per_hari' => 350000,
                'status' => 'Tersedia',
                'warna' => 'Putih',
                'tahun' => 2021,
                'gambar' => 'xenia.jpg'
            ],
            [
                'nama_mobil' => 'Mitsubishi Xpander',
                'jenis_mobil' => 'MPV',
                'harga_sewa_per_hari' => 370000,
                'status' => 'Tersedia',
                'warna' => 'Hitam',
                'tahun' => 2022,
                'gambar' => 'avanza_hitam.png'
            ],
            [
                'nama_mobil' => 'Toyota Yaris',
                'jenis_mobil' => 'City Car',
                'harga_sewa_per_hari' => 300000,
                'status' => 'Tersedia',
                'warna' => 'Kuning',
                'tahun' => 2021,
                'gambar' => 'brio_kuning.png'
            ],
            [
                'nama_mobil' => 'Toyota Yaris',
                'jenis_mobil' => 'City Car',
                'harga_sewa_per_hari' => 320000,
                'status' => 'Tersedia',
                'warna' => 'Merah',
                'tahun' => 2022,
                'gambar' => 'brio_merah.png'
            ],
            [
                'nama_mobil' => 'Suzuki Ertiga',
                'jenis_mobil' => 'MPV',
                'harga_sewa_per_hari' => 320000,
                'status' => 'Tersedia',
                'warna' => 'Abu-abu',
                'tahun' => 2021,
                'gambar' => 'pajero.jpg'
            ],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}
