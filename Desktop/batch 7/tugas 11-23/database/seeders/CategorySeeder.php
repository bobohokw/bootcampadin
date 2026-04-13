<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kita pakai DB::table agar lebih cepat dan langsung ke sasaran
        DB::table('categories')->insert([
            [
                'name' => 'Electronic', // 🔥 Ganti dari 'nama_kategori' ke 'name'
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Clothing',   // 🔥 Harus 'name'
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Food',       // 🔥 Harus 'name'
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}