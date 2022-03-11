<?php

namespace App\Http\Controllers\Cart;
use App\User;
use Auth;
use Cart;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Setting\ShippingCost;

class CartController extends Controller
{
    

       public function shippingAmount()
    {

        $shipping = ShippingCost::find(1);
        return $shipping;
    }

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


     public function checkOutPage()
    {
        $payment_method = PaymentSetting::select('id', 'provider')->where('status', '=', 1)->get();
        return view('front.checkout.checkout', [
            'payment_method' => $payment_method,
        ]);

    }


        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            Cart::instance('shopping')->remove($id);

            return response()->json(['status' => 'success', 'message' => 'item removed']);
        } catch (\Exception $e) {
            return $e;
        }
    }


    public function update($id, $status)
    {
        $cart = Cart::instance('shopping')->get($id);

        if ($status == 'decrement') {
            $qty = $cart->qty - 1;

            Cart::instance('shopping')->update($id, $qty);

            return response()->json(['status' => 'success', 'message' => 'Item Decreased']);
        } else {

            if ($cart->qty + 1 > $cart->options->stock) {
                return response()->json(['status' => 'error', 'message' => 'out of stock']);
            } else {

                Cart::instance('shopping')->update($id, $cart->qty + 1);
                return response()->json(['status' => 'success', 'message' => 'Item Increased']);

            }

        }

    }

     public function store(Request $request)
    {

        try {

            $id           = $request->id;
            $product_name = $request->product_name;
            $qty          = $request->qty;
            $price        = $request->price;
            $current_qty  = $request->current_qty;
            $image        = $request->product_image;
            $qty_unit     = $request->qty_unit;
            $discount     = $request->discount;

            if ($qty_unit != '') {
                $product_name = $product_name . '(' . $qty_unit . ')';
            }

            // checking available in stock
            if ($qty > $current_qty) {
                return response()->json(['status' => 'error', 'message' => 'Product out of Stock']);

                return 'error';

            }
            $cart = Cart::instance('shopping')->content()->where('id', $id)->first();

            // checking if cart have the product alredy
            if ($cart) {

                if ($cart->qty + $qty > $current_qty) {
                    return response()->json(['status' => 'error', 'message' => 'Product out of Stock']);
                }

            }

            Cart::instance('shopping')->add(['id' => $id,
                'name'                                => $product_name,
                'qty'                                 => $qty,
                'price'                               => $price,
                'weight'                              => 0,
                'options'                             =>
                [
                    'image'      => $image,
                    'stock'      => $current_qty,
                    'discount'   => (float) $discount,
                    'size_id'    => $request->size_id,
                    'size_name'  => $request->size_name,
                    'color_id'   => $request->color_id,
                    'color_name' => $request->color_name,
                    'color_code' => $request->color_code,
                ]
                , 'discount' => 0]);

            return response()->json(['status' => 'success', 'message' => 'Product Added To Cart']);

        } catch (\Exception $e) {

            return $e;

        }
    }


}
