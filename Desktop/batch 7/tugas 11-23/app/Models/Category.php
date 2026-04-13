<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // ⚡ FIX: Ganti 'nama_kategori' menjadi 'name' agar sinkron dengan Database & Seeder
    protected $fillable = [
        'name'
    ];

    /**
     * Relasi ke Product (Satu kategori punya banyak produk)
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}