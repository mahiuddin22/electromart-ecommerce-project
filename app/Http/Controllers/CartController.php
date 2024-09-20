<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function cart(Request $request, $id)
    {
        // Check multiple quantity or not
        if($request->quantity != null){
            $quantity = $request->quantity;
        }else{
            $quantity = 1;
        }

        $product = Product::where('id', $id)->first();
        
        // Check discounted product or not
        if ($product->discount != null) {
            $offerd = $product->price * $product->discount / 100;
            $price = $product->price - $offerd;
        }else{
            $price = $product->price;
        }
        $cart_old_data = Cart::where('product_id', $product->id)->where('user_id', auth()->user()->id)->first();




        if ($cart_old_data != null) {
            if ($cart_old_data->product_id == $product->id) {

                $updated_qty = $cart_old_data->product_quantity = $cart_old_data->product_quantity + $quantity;
                $cart_old_data->product_quantity  = $updated_qty;
                $cart_old_data->product_subtotal  = $price * $updated_qty;
                $cart_old_data->save();
                return redirect()->back()->with('message', 'Product Added to Cart');
            }
        } else {
            $cart = new Cart();
            $cart->user_id          = auth()->user()->id;
            $cart->product_id       = $product->id;
            $cart->product_image    = $product->image;
            $cart->product_name     = $product->name;
            $cart->product_price    = $price;
            $cart->product_quantity = $quantity;
            $cart->product_subtotal = $price * $quantity;
            $cart->save();
            return redirect()->back()->with('message', 'Product Added to Cart');
        }
    }
    
    public function cartDetails(){
        $carts = Cart::where('user_id',auth()->user()->id)->get();
        $subtotal = $carts->sum('product_subtotal');
        $shipping_cost = 100;
        return view('frontpanel.cartdetails', compact('carts','subtotal','shipping_cost'));
    }

    public function cartUpdate(Request $request, $id){
        if($request->product_quantity < 1){
            $quantity = 1;
        }else{
            $quantity = $request->product_quantity;
        }
        $cart = Cart::where('id',$id)->first();
        $cart->product_quantity = $quantity;
        $cart->product_subtotal  = $cart->product_price * $quantity;
        $cart->save();
        return redirect()->back()->with('message', 'Product Succescully Updated');
    }

    public function destroy($id){
        $cart = Cart::where('id',$id)->where('user_id', auth()->user()->id)->delete();
        return redirect()->back()->with('message', 'Product Deleted From Cart');
    }
}
