<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('featured', true)
            ->where('status', true)
            ->latest()
            ->take(8)
            ->get();

        $bestSellers = Product::withSum('orderItems', 'quantity')
            ->orderByDesc('order_items_sum_quantity')
            ->take(4)
            ->get();

        return view('front.home', compact(
            'featuredProducts',
            'bestSellers'
        ));
    }
}
