<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'size' => 'required',
            'color' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        $cart = session()->get('cart', []);

        $cartKey = $product->id . '_' . $request->size . '_' . $request->color;

        if (isset($cart[$cartKey])) {

            $cart[$cartKey]['quantity'] += $request->quantity;
        } else {

            $cart[$cartKey] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->sale_price ?? $product->price,
                'image' => $product->image,
                'quantity' => $request->quantity,
                'size' => $request->size,
                'color' => $request->color,
            ];
        }

        session()->put('cart', $cart);

        return back()->with(
            'success',
            'Produk berhasil ditambahkan ke keranjang'
        );
    }



    public function index()
    {
        $cart = session()->get('cart', []);

        $total = 0;


        foreach ($cart as $item) {

            $total += $item['price'] * $item['quantity'];
        }


        return view('front.cart', compact(
            'cart',
            'total'
        ));
    }

    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)
            ->where('status', true)
            ->where(function ($query) {
                $query->whereNull('expired_at')
                    ->orWhere('expired_at', '>=', now());
            })
            ->first();

        if (!$coupon) {
            return back()->with(
                'error',
                'Voucher tidak valid'
            );
        }

        $total = collect(session('cart', []))
            ->sum(fn($item) => $item['price'] * $item['quantity']);

        if ($total < $coupon->minimum_purchase) {
            return back()->with(
                'error',
                'Minimal belanja Rp ' . number_format($coupon->minimum_purchase)
            );
        }

        session([
            'coupon_code' => $coupon->code,
            'coupon_discount' => $coupon->discount_percent,
        ]);

        return back()->with(
            'success',
            'Voucher berhasil digunakan'
        );
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);


        if (isset($cart[$id])) {

            $cart[$id]['quantity'] = $request->quantity;


            if ($cart[$id]['quantity'] < 1) {
                $cart[$id]['quantity'] = 1;
            }
        }


        session()->put('cart', $cart);


        return redirect()->back();
    }


    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);


        return redirect()->back();
    }
}
