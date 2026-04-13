<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Pastikan Kategori Ada (Hanya pakai 'name' karena 'slug' tidak ada di tabelmu)
        DB::table('categories')->updateOrInsert(['name' => 'Electronic'], ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        DB::table('categories')->updateOrInsert(['name' => 'Clothing'], ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        DB::table('categories')->updateOrInsert(['name' => 'Food'], ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);

        // Ambil ID kategori
        $electronicId = DB::table('categories')->where('name', 'Electronic')->value('id');
        $clothingId = DB::table('categories')->where('name', 'Clothing')->value('id');
        $foodId = DB::table('categories')->where('name', 'Food')->value('id');

        // 2. Data 12 Produk
        DB::table('products')->insert([
            [
                'category_id' => $electronicId,
                'nama_produk' => 'Laptop Gaming',
                'description' => 'Laptop spek tinggi untuk gaming',
                'harga' => 15000000,
                'stok' => 10,
                'image' => 'Laptop Gaming.jpg',
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => $clothingId,
                'nama_produk' => 'Kaos Polos',
                'description' => 'Kaos nyaman dipakai sehari-hari',
                'harga' => 50000,
                'stok' => 50,
                'image' => 'Kaos Polos.jpg',
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => $foodId,
                'nama_produk' => 'Snack Coklat',
                'description' => 'Cemilan enak dan manis',
                'harga' => 10000,
                'stok' => 100,
                'image' => 'Snack Coklat.jpg',
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => $electronicId,
                'nama_produk' => 'Mouse Wireless',
                'description' => 'Mouse responsif tanpa kabel',
                'harga' => 250000,
                'stok' => 30,
                'image' => 'mouse.jpg',
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => $electronicId,
                'nama_produk' => 'Keyboard Mechanical',
                'description' => 'Keyboard RGB switch biru',
                'harga' => 750000,
                'stok' => 15,
                'image' => 'keyboard.jpg',
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => $electronicId,
                'nama_produk' => 'Monitor 24 Inch',
                'description' => 'Monitor IPS Full HD 75Hz',
                'harga' => 1800000,
                'stok' => 12,
                'image' => 'monitor.jpg',
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => $clothingId,
                'nama_produk' => 'Jaket Hoodie',
                'description' => 'Hoodie hangat bahan fleece',
                'harga' => 225000,
                'stok' => 20,
                'image' => 'hoodie.jpg',
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => $clothingId,
                'nama_produk' => 'Celana Chino',
                'description' => 'Celana panjang slim fit casual',
                'harga' => 180000,
                'stok' => 25,
                'image' => 'chino.jpg',
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => $clothingId,
                'nama_produk' => 'Topi Snapback',
                'description' => 'Topi distro kualitas premium',
                'harga' => 85000,
                'stok' => 40,
                'image' => 'topi.jpg',
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => $foodId,
                'nama_produk' => 'Minuman Soda',
                'description' => 'Minuman segar pelepas dahaga',
                'harga' => 7000,
                'stok' => 150,
                'image' => 'soda.jpg',
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => $foodId,
                'nama_produk' => 'Kopi Botol',
                'description' => 'Kopi susu gula aren siap minum',
                'harga' => 12000,
                'stok' => 60,
                'image' => 'kopi.jpg',
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => $foodId,
                'nama_produk' => 'Mie Instan',
                'description' => 'Mie instan goreng rasa spesial',
                'harga' => 3500,
                'stok' => 300,
                'image' => 'mie.jpg',
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            ],
        ]);
    }
}