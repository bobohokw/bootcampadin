<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * ✅ TAMPILKAN ISI KERANJANG (DARI DATABASE)
     */
    public function index()
    {
        // Mengambil data cart milik user yang sedang login beserta data produknya
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('cart.index', compact('carts'));
    }

    /**
     * ✅ TAMBAH KE KERANJANG
     */
    public function add(Request $request, $id)
    {
        // 1. Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // 2. Cari produknya
        $product = Product::findOrFail($id);

        // 3. Cek apakah produk ini sudah ada di keranjang user tersebut
        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->first();

        if ($cart) {
            // Jika sudah ada, tambahkan jumlahnya (qty)
            // Gunakan qty dari input form, jika tidak ada default 1
            $cart->qty += $request->quantity ?? 1;
            $cart->save();
        } else {
            // Jika belum ada, buat data keranjang baru
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $id,
                'qty' => $request->quantity ?? 1
            ]);
        }

        // Redirect ke halaman keranjang dengan pesan sukses
        return redirect()->route('cart.index')->with('success', 'Produk berhasil dimasukkan ke keranjang DinoMarket!');
    }

    /**
     * ✅ HAPUS ITEM DARI KERANJANG (AMAN)
     */
    public function delete($id)
    {
        // Pastikan hanya bisa menghapus cart miliknya sendiri
        $cart = Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $cart->delete();

        return back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}