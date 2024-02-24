<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::orderBy('id', 'DESC');

        $search = $request->get('search');

        if ($search) {
            $products = $products->where('name', 'like', '%' . $search . '%');
        }

        $products = $products->paginate(8);

        return view('frontend.products.index', compact('products'));
    }

    public function productsByCategory($slug)
    {
        $category = Category::with('products')->where('slug', $slug)->first();
        $products = $category->products()->orderBy('id', 'DESC')->paginate(8);

        return view('frontend.products.by_category', compact('category', 'products'));
    }

    public function show($slug)
    {
        $product = Product::with(
            'category',
            'productBrand',
            'carModels',
            'productImages'
        )->where('slug', $slug)->first();

        return view('frontend.products.show', compact('product'));
    }
}
