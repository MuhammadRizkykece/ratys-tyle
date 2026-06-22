<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('status', 1);

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->brand) {
            $query->where('brand_id', $request->brand);
        }

        if ($request->sort == 'low') {
            $query->orderBy('price');
        }

        if ($request->sort == 'high') {
            $query->orderByDesc('price');
        }

        $products = $query->paginate(12);

        $categories = Category::all();
        $brands = Brand::all();

        return view('front.shop', compact(
            'products',
            'categories',
            'brands'
        ));
    }
}
