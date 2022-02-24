<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    
    public function CartItem()
    {

        $cart_items = Cart::instance('shopping')->content();
        $cart_total = Cart::instance('shopping')->subtotal();
        $cart_count = Cart::instance('shopping')->count();

        return response()->json([
            'cart_items' => $cart_items,
            'cart_total' => (float) $cart_total,
            'cart_count' => $cart_count,
        ]);

    }
}
