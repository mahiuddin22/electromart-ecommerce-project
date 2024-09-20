<?php

namespace App\Http\Controllers\Frontpanel;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productDetails($id)
    {
        $reviews = Review::where('product_id', $id)->get();
        $product           = Product::where('id', $id)->first();
        $releted_products  = Product::where('category_id', $product->category_id)->get();
        $i = 1;
        return view('frontpanel.single', compact('product', 'releted_products','reviews','i'));
    }

    public function CatProduct($id)
    {
        $categories = Category::with('subcategories')->get();
        $brands = Brand::where('status', 1)->get();
        $catproducts = Product::where('category_id', $id)->paginate(12);
        return view('frontpanel.catproduct', compact('catproducts','brands','categories'));
    }

    public function subCatProduct($id)
    {
        $categories = Category::with('subcategories')->get();
        $brands = Brand::where('status', 1)->get();
        $subcatproducts = Product::where('subcategory_id', $id)->paginate(12);
        return view('frontpanel.subcatproduct', compact('subcatproducts','brands','categories'));
    }

    public function brandProduct($id)
    {
        $categories = Category::with('subcategories')->get();
        $brands = Brand::where('status', 1)->get();
        $brandproducts = Product::where('brand_id', $id)->paginate(12);
        return view('frontpanel.brandproduct', compact('brandproducts','brands','categories'));
    }

    public function productCart()
    {
        return view('frontpanel.cart');
    }
}
