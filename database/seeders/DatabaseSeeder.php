<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Muhammad Taufiq',
            'email' => 'viqazhari.if10@gmail.com',
            'password' => bcrypt('admin123')
        ]);

        User::create([
            'name' => 'Muhammad Ramdani',
            'email' => 'ramdani@gmail.com',
            'password' => bcrypt('admin321')
        ]);

        Pelanggan::create([
            'name' => 'Sendy',
            'phone' => '1234',
            'address' => 'Jl....'
        ]);

        Pelanggan::create([
            'name' => 'Farhan',
            'phone' => '1234',
            'address' => 'Jl....'
        ]);

        Pelanggan::create([
            'name' => 'Pembeli',
            'phone' => '1234',
            'address' => 'Jl....'
        ]);

        Produk::create([
            'kode_produk' => '8993988260349',
            'name' => 'Produk A',
            'price' => 10000,
            'stok' => 38
        ]);

        Produk::create([
            'kode_produk' => '8998838680896',
            'name' => 'Produk B',
            'price' => 10000,
            'stok' => 100
        ]);
    }
}
