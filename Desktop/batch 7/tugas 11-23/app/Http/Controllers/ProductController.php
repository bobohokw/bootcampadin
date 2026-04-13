<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * ✅ TAMPILKAN KATALOG PRODUK (UNTUK USER)
     * Ini yang akan membuat produk lama kamu muncul di halaman depan!
     */
    public function katalog()
    {
        // Mengambil semua produk untuk ditampilkan ke pembeli
        $products = Product::with('category')->latest()->get();
        
        // Sesuaikan 'welcome' dengan nama file blade halaman depan kamu
        return view('welcome', compact('products')); 
    }

    /**
     * ✅ TAMPILKAN DAFTAR PRODUK (Tabel CRUD Admin - Tugas 21/22)
     */
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('products.list', compact('products'));
    }

    /**
     * ✅ TAMPILKAN DETAIL PRODUK (TUGAS 23 - HITUNG KLIK)
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        // Logika Tugas 23: Setiap kali detail dibuka, jumlah klik bertambah 1
        $product->increment('clicks');

        return view('products.show', compact('product'));
    }

    /**
     * ✅ FORM TAMBAH PRODUK (TUGAS 21)
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * ✅ SIMPAN PRODUK BARU (TUGAS 21)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'description' => 'required|string',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'nama_produk' => $request->nama_produk,
            'description' => $request->description,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
            'category_id' => $request->category_id,
            'image'       => $imagePath,
            'clicks'      => 0, 
        ]);

        return redirect()->route('products.list')->with('success', 'Produk DinoMarket berhasil dipajang! 🦖');
    }

    /**
     * ✅ FORM EDIT PRODUK (TUGAS 22)
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * ✅ UPDATE DATA PRODUK (TUGAS 22)
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'description' => 'required',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['nama_produk', 'description', 'harga', 'stok', 'category_id']);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.list')->with('success', 'Data produk berhasil diperbarui! 🦖✨');
    }

    /**
     * ✅ HAPUS PRODUK (TUGAS 22)
     */
    public function delete($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        
        return redirect()->route('products.list')->with('success', 'Produk berhasil dihapus! 🗑️');
    }
}