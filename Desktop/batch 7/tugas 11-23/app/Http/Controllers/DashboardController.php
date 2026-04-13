<?php

namespace App\Http\Controllers;

use App\Models\Product;    // Wajib diimport untuk hitung produk
use App\Models\Category;   // Wajib diimport untuk hitung kategori
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * ✅ MENAMPILKAN DATA STATISTIK DI DASHBOARD (TUGAS 23)
     */
    public function index()
    {
        // 1. Menghitung total semua produk yang ada di database
        $totalProduk = Product::count();

        // 2. Menghitung total semua kategori yang ada
        $totalKategori = Category::count();

        // 3. Menghitung total klik dari semua produk (menggunakan sum)
        // Fungsi sum('clicks') akan menjumlahkan semua angka di kolom clicks
        $totalKlik = Product::sum('clicks');

        // 4. Kirim data ke view admin/dashboard.blade.php
        return view('admin.dashboard', compact(
            'totalProduk', 
            'totalKategori', 
            'totalKlik'
        ));
    }
}