<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->get();

        return view('front.category', compact('categories'));
    }


    public function show($slug)
    {
        $category = Category::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();


        $products = Product::where('category_id', $category->id)
            ->where('status', 1)
            ->paginate(12);


        return view('front.category-detail', compact(
            'category',
            'products'
        ));
    }
}
