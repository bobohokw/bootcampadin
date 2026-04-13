<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'nama_produk',
        'description', // 🔥 FIX: Menggunakan 'description' agar sinkron dengan database
        'harga',
        'stok',
        'image'
    ];

    /**
     * Relasi ke Category (Produk ini milik sebuah kategori)
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * ✅ Relasi ke Wishlist (BARU)
     * Memungkinkan sistem untuk mengecek siapa saja yang menyukai produk ini
     */
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}