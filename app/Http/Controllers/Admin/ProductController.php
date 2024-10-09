<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products      = Product::orderBy('id','DESC')->paginate(15);
        $categories    = Category::all();
        $subcategories = SubCategory::all();
        $brands        = Brand::all();
        return view('adminpanel.product.index', compact('products','categories','subcategories','brands'));
    }

    public function create()
    {
        $products      = Product::all();
        $categories    = Category::all();
        $subcategories = SubCategory::all();
        $brands        = Brand::all();
        return view('adminpanel.product.create',compact('products','categories','subcategories','brands'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'short_des' => 'required',
            'image' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        $image = $request->file('image');
        if (isset($image)) {
            $currendate = Carbon::now()->toDateString();
            $imagename = $currendate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('public/uploads/product')) {
                mkdir('public/uploads/product', 0777, true);
            }
            $image->move('public/uploads/product', $imagename);
        } else {
            $imagename = 'default.png';
        }

        $product = new Product();
        $product->name           = $request->name;
        $product->category_id    = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->brand_id       = $request->brand_id;
        $product->short_des      = $request->short_des;
        $product->long_des       = $request->long_des;
        $product->specifications = $request->specifications;
        $product->image          = $imagename;
        $product->price          = $request->price;
        $product->quantity       = $request->quantity;
        $product->discount       = $request->discount;
        $product->featured       = $request->featured;
        $product->status         = $request->status;
        $product->save();
        return redirect()->route('product')->with('message', 'Data added successfully');
    }

    public function edit($id)
    {
        $product      = Product::findOrFail($id);
        $categories    = Category::all();
        $subcategories = SubCategory::all();
        $brands        = Brand::all();
        return view('adminpanel.product.edit', compact('product','categories','subcategories','brands'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [

            'name' => 'required|string',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'short_des' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        $product = Product::findOrFail($id);

        $image = $request->file('image');
        if (isset($image)) {
            $currendate = Carbon::now()->toDateString();
            $imagename = $currendate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('public/uploads/product')) {
                mkdir('public/uploads/product', 0777, true);
            }
            if (file_exists('public/uploads/product/' . $product->image)) {
                unlink('public/uploads/product/' . $product->image);
            }
            $image->move('public/uploads/product', $imagename);
        } else {
            $imagename = $product->image;
        }

        $product->name           = $request->name;
        $product->category_id    = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->brand_id       = $request->brand_id;
        $product->short_des      = $request->short_des;
        $product->long_des       = $request->long_des;
        $product->specifications = $request->specifications;
        $product->image          = $imagename;
        $product->price          = $request->price;
        $product->quantity       = $request->quantity;
        $product->discount       = $request->discount;
        $product->featured       = $request->featured;
        $product->status         = $request->status;
        $product->save();
        return redirect()->route('product')->with('message', 'Data updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if (file_exists('public/uploads/product/' . $product->image)) {
            unlink('public/uploads/product/' . $product->image);
        }
        $product->delete();
        return redirect()->back()->with('message', 'Data deleted successfully');
    }
}
