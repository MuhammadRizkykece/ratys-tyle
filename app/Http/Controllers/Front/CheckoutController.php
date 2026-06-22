<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
// use Midtrans\Config;
// use Midtrans\Snap;
// use Midtrans\Notification;

class CheckoutController extends Controller
{

    public function index()
    {
        $cart = session()->get('cart', []);


        if (count($cart) == 0) {

            return redirect('/cart')
                ->with('error', 'Keranjang masih kosong');
        }


        $total = 0;


        foreach ($cart as $item) {

            $total += $item['price'] * $item['quantity'];
        }


        return view('front.checkout', compact(
            'cart',
            'total'
        ));
    }



    public function store(Request $request)
    {

        $request->validate([

            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',

        ]);


        $cart = session()->get('cart', []);

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $discount = session('coupon_discount', 0);

        $discountAmount = ($total * $discount) / 100;

        $grandTotal = $total - $discountAmount;



        $order = Order::create([

            'user_id' => Auth::id(),

            'name' => $request->name,

            'phone' => $request->phone,

            'address' => $request->address,

            'total' => $grandTotal,

            'status' => 'pending',

        ]);

        // Config::$serverKey = config('midtrans.server_key');
        // Config::$isProduction = config('midtrans.is_production');
        // Config::$isSanitized = true;
        // Config::$is3ds = true;

        // $params = [
        //     'transaction_details' => [
        //         'order_id' => $order->id,
        //         'gross_amount' => (int) $grandTotal,
        //     ],
        //     'customer_details' => [
        //         'first_name' => $request->name,
        //         'phone' => $request->phone,
        //         'email' => Auth::user()->email,
        //     ],
        // ];

        // dd(config('midtrans'));
        // $snapToken = Snap::getSnapToken($params);

        // $order->update([
        //     'snap_token' => $snapToken,
        // ]);


        foreach ($cart as $id => $item) {


            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'size' => $item['size'],
                'color' => $item['color'],
            ]);


            Product::where('id', $id)
                ->decrement('stock', $item['quantity']);
        }



        session()->forget('cart');
        session()->forget('coupon_code');
        session()->forget('coupon_discount');

        return redirect()
            ->route('my-orders.show', $order->id);
    }

    // public function callback(Request $request)
    // {
    //     Config::$serverKey = config('midtrans.server_key');
    //     Config::$isProduction = config('midtrans.is_production');

    //     $notification = new Notification();

    //     $order = Order::find($notification->order_id);

    //     if (!$order) {
    //         return response()->json([
    //             'message' => 'Order tidak ditemukan'
    //         ], 404);
    //     }

    //     if (
    //         $notification->transaction_status == 'capture' ||
    //         $notification->transaction_status == 'settlement'
    //     ) {

    //         $order->update([
    //             'payment_status' => 'paid',
    //             'status' => 'processing',
    //         ]);
    //     }

    //     if (
    //         $notification->transaction_status == 'expire'
    //     ) {

    //         $order->update([
    //             'payment_status' => 'expired',
    //         ]);
    //     }

    //     if (
    //         $notification->transaction_status == 'cancel'
    //     ) {

    //         $order->update([
    //             'payment_status' => 'cancelled',
    //         ]);
    //     }

    //     return response()->json([
    //         'success' => true
    //     ]);
    // }
}
