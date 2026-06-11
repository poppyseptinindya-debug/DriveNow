<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Admin User
        User::updateOrCreate(
            ['email' => 'admin@drivenow.com'],
            [
                'name' => 'Admin DriveNow',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Seed Customer User
        $customerBudi = User::updateOrCreate(
            ['email' => 'budi@customer.com'],
            [
                'name' => 'Budi Customer',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ]
        );

        $customerAni = User::updateOrCreate(
            ['email' => 'ani@customer.com'],
            [
                'name' => 'Ani Customer',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ]
        );

        $customerRudi = User::updateOrCreate(
            ['email' => 'rudi@customer.com'],
            [
                'name' => 'Rudi Customer',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ]
        );

        $customerSiti = User::updateOrCreate(
            ['email' => 'siti@customer.com'],
            [
                'name' => 'Siti Customer',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ]
        );

        $customerAgus = User::updateOrCreate(
            ['email' => 'agus@customer.com'],
            [
                'name' => 'Agus Customer',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ]
        );

        $this->call([
            CarSeeder::class,
        ]);
    }
}
