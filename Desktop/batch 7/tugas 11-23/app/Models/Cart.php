<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'carts';

    // Kolom yang boleh diisi secara massal (Mass Assignment)
    protected $fillable = [
        'user_id',
        'product_id',
        'qty'
    ];

    /**
     * ✅ RELASI KE PRODUK
     * Menghubungkan data keranjang dengan tabel produk.
     * Digunakan untuk mengambil nama_produk, harga, dan gambar.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * ✅ RELASI KE USER
     * Menghubungkan data keranjang dengan tabel users.
     * Memastikan satu keranjang hanya milik satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}