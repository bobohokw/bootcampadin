<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('wishlist.index', compact('wishlist'));
    }

    public function add($id)
    {
        $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $id)->first();

        if (!$exists) {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $id
            ]);
            return back()->with('success', 'Produk berhasil ditambah ke wishlist!');
        }

        return back()->with('success', 'Produk sudah ada di wishlist.');
    }

    public function remove($id)
    {
        Wishlist::where('user_id', Auth::id())->where('product_id', $id)->delete();
        return back()->with('success', 'Produk dihapus dari wishlist.');
    }
}