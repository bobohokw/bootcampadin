<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Category; // Penting untuk menghitung jumlah kategori
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * ✅ DASHBOARD UTAMA (TUGAS 18 + DATA RINGKASAN TOKO)
     * Fungsi ini mengumpulkan semua data statistik untuk ditampilkan di dashboard admin.
     */
    public function dashboard()
    {
        // 1. Mengambil Data Dasar Toko
        // Menghitung jumlah baris di setiap tabel masing-masing
        $totalProduk = Product::count();
        $totalOrder  = Order::count();
        $totalUser   = User::count();

        // 2. Data Tambahan Spesifik Tugas 18
        // Menghitung total kategori yang tersedia
        $totalKategori = Category::count();
        
        // Menjumlahkan seluruh angka di kolom 'clicks' pada tabel products
        $totalKlik     = Product::sum('clicks');

        // 3. Mengambil 5 Produk Terpopuler
        // Diurutkan berdasarkan jumlah klik terbanyak (descending)
        $produkTerpopuler = Product::with('category') // Eager loading agar tidak berat saat ambil nama kategori
            ->orderBy('clicks', 'desc')
            ->take(5)
            ->get();

        // 4. Mengirim semua variabel ke view admin.dashboard
        return view('admin.dashboard', compact(
            'totalProduk',
            'totalOrder',
            'totalUser',
            'totalKategori',
            'totalKlik',
            'produkTerpopuler'
        ));
    }
}