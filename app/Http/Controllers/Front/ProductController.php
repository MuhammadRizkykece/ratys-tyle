<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::with([
            'brand',
            'category',
            'variants',
            'reviews.user',
            'images',
        ])
            ->withAvg('reviews', 'rating')
            ->where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $variants = $product->variants;

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 1)
            ->take(4)
            ->get();

        return view('front.product-detail', compact(
            'product',
            'variants',
            'relatedProducts'
        ));
    }

    public function review(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|min:1|max:5',
            'comment' => 'required',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with(
            'success',
            'Review berhasil ditambahkan'
        );
    }
}
