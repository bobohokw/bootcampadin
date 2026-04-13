<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * ✅ TAMPILKAN DAFTAR KATEGORI
     * Menampilkan tabel dengan kolom ID, Nama, dan Jumlah Produk
     */
    public function index()
    {
        // withCount('products') otomatis menghitung jumlah produk yang terhubung ke kategori tersebut
        $categories = Category::withCount('products')->latest()->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * ✅ FORM TAMBAH KATEGORI (TUGAS 21 - Poin 1)
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * ✅ SIMPAN KATEGORI BARU (TUGAS 21 - Poin 4)
     * Memvalidasi input dan menyimpannya di database sesuai instruksi Tugas 21.
     */
    public function store(Request $request)
    {
        // 1. Validasi agar nama kategori tidak kosong dan tidak duplikat (Tugas 21)
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name'
        ]);

        // 2. Simpan ke database (Tugas 21)
        Category::create([
            'name' => $request->name
        ]);

        // 3. Redirect ke halaman index dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Kategori baru DinoMarket berhasil ditambahkan! 🦖');
    }

    /**
     * ✅ FORM EDIT KATEGORI
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * ✅ UPDATE DATA KATEGORI
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id
        ]);

        $category->update([
            'name' => $request->name
        ]);

        return redirect()->route('categories.index')->with('success', 'Nama kategori berhasil diperbarui!');
    }

    /**
     * ✅ HAPUS KATEGORI
     */
    public function delete($id)
    {
        $category = Category::findOrFail($id);
        
        // Cek apakah kategori masih memiliki produk sebelum dihapus
        if ($category->products()->count() > 0) {
            return redirect()->route('categories.index')->with('error', 'Kategori tidak bisa dihapus karena masih memiliki produk!');
        }

        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}