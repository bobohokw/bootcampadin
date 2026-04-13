<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class OrderController extends Controller
{
    /**
     * ✅ TAMPILKAN RIWAYAT PESANAN (TUGAS 24 - TRACKING)
     */
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * ✅ PROSES CHECKOUT & GENERATE MIDTRANS SNAP TOKEN
     */
    public function process(Request $request)
    {
        // 1. Ambil data keranjang user
        $cartItems = Cart::where('user_id', auth()->id())->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja kamu masih kosong! 🦖');
        }

        $firstItem = $cartItems->first();

        // Hitung total harga dari semua item di keranjang
        $totalHarga = $cartItems->sum(function($item) {
            return $item->product->harga * $item->quantity;
        });

        // 2. Simpan data pesanan ke database (Sesuai Migrasi Tugas 13 & 24)
        $order = Order::create([
            'user_id'      => auth()->id(),
            'product_id'   => $firstItem->product_id, 
            'order_number' => 'DINO-' . strtoupper(uniqid()),
            'quantity'     => $cartItems->sum('quantity'),
            'total_price'  => $totalHarga,
            'status'       => 'pending',
        ]);

        // 3. Konfigurasi Midtrans
        Config::$serverKey    = config('services.midtrans.server_key'); 
        Config::$isProduction = false;
        Config::$isSanitized  = true;
        Config::$is3ds        = true;

        $params = [
            'transaction_details' => [
                'order_id'     => $order->order_number,
                'gross_amount' => (int) $order->total_price,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email'      => auth()->user()->email,
            ],
        ];

        try {
            // 4. Minta Snap Token dari Midtrans
            $snapToken = Snap::getSnapToken($params);
            
            // Simpan token ke database
            $order->update(['snap_token' => $snapToken]);

            // 5. Kosongkan keranjang belanja setelah checkout diproses
            Cart::where('user_id', auth()->id())->delete();

            return view('orders.payment', compact('order', 'snapToken'));

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    /**
     * ✅ CALLBACK DARI MIDTRANS (WEBHOOK)
     * Mengubah status pesanan secara otomatis saat dibayar
     */
    public function callback(Request $request)
    {
        Config::$serverKey = config('services.midtrans.server_key');
        $notif = new Notification();

        $transaction = $notif->transaction_status;
        $order_id = $notif->order_id;

        $order = Order::where('order_number', $order_id)->first();

        if ($order) {
            if ($transaction == 'settlement') {
                $order->update(['status' => 'lunas']);
            } else if ($transaction == 'pending') {
                $order->update(['status' => 'pending']);
            } else if ($transaction == 'deny' || $transaction == 'expire' || $transaction == 'cancel') {
                $order->update(['status' => 'gagal']);
            }
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * ✅ UPDATE STATUS PESANAN (DITERIMA OLEH USER)
     */
    public function complete($id)
    {
        $order = Order::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        // Sesuai alur marketplace: lunas -> dikirim -> selesai
        $order->update(['status' => 'selesai']);

        return redirect()->route('orders.index')->with('success', 'Terima kasih! Pesanan DinoMarket telah sampai di tanganmu. 🦖✨');
    }
}