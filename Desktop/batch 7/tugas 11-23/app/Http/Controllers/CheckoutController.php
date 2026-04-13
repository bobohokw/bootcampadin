<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{

public function checkout()
{

$carts=Cart::with('product')
->where('user_id',auth()->id())
->get();

$total=0;

foreach($carts as $c){

$total+=$c->product->harga*$c->qty;

}

$order=Order::create([
'user_id'=>auth()->id(),
'total'=>$total
]);

foreach($carts as $c){

OrderItem::create([

'order_id'=>$order->id,
'product_id'=>$c->product_id,
'qty'=>$c->qty,
'harga'=>$c->product->harga

]);

}

Cart::where('user_id',auth()->id())->delete();

return redirect('/orders');

}

}