<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use App\Models\OrderHistory;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Mail\AdminMail;
use App\Mail\OrderConfirmationMail;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $user    = User::where('id',$user_id)->first();

        $post_data = array();
        $post_data['total_amount'] = $request->grand_total; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $user->name;
        $post_data['cus_email'] = $user->email;
        $post_data['cus_add1'] = $request->shipping_address;
        $post_data['cus_add2'] = $request->shipping_address;
        // $post_data['cus_city'] = "";
        $post_data['cus_state'] = $request->state;
        $post_data['cus_postcode'] = '1234';
        $post_data['cus_country'] = 'Bangladesh';
        $post_data['cus_phone'] = 01760440622;
        // $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = $request->shipping_address;
        $post_data['ship_add2'] = $request->shipping_address;
        // $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = $request->state;
        $post_data['ship_postcode'] = '1234';
        $post_data['ship_phone'] = '01760445566';
        $post_data['ship_country'] = 'Bangladesh';

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        $old_address = $request->old_address;
        $old_mobile = $request->old_mobile;
        if ($old_address == null || $old_mobile == null) {
            $request->validate([
                'shipping_address' => ['required'],
                'mobile'           => ['required'],
                'payment_method'   => ['required'],
                'grand_total'      => ['required'],
            ]);
        } else {
            $request->validate([
                'old_address'      => ['required'],
                'old_mobile'       => ['required'],
                'payment_method'   => ['required'],
                'grand_total'      => ['required'],
            ]);
        }

        
        $id      = abs(crc32(uniqid()));
        $checkout = new Checkout();
        $checkout->order_no         = $id;
        $checkout->user_id          = $user->id;

        if ($request->old_address    == 'on') {
            $checkout->shipping_address = $user->address;
        } else {
            $checkout->shipping_address = $request->shipping_address;
        }

        if ($request->old_mobile    == 'on') {
            $checkout->mobile = $user->mobile;
        } else {
            $checkout->mobile = $request->mobile;
        }

        $checkout->payment_method   = $request->payment_method;
        $checkout->grand_total      = $request->grand_total;
        $checkout->save();

        $carts = Cart::where('user_id', $user->id)->get();

        foreach ($carts as $cart) {
            $order = new OrderHistory();
            $order->checkout_id      = $checkout->id;
            $order->user_id          = $cart->user_id;
            $order->product_id       = $cart->product_id;
            $order->product_price    = $cart->product_price;
            $order->product_quantity = $cart->product_quantity;
            $order->product_subtotal = $cart->product_subtotal;
            $order->save();

            $product = Product::where('id', $cart->product_id)->first();
            $product->quantity = $product->quantity - $cart->product_quantity;
            $product->save();
        }

        
        $checkout  = Checkout::where('user_id', $user->id)->where('id', $checkout->id)->first();
        
        Mail::to($user->email)->send(new OrderConfirmationMail($checkout));
        Mail::to('mahiuddin.noyon@gmail.com')->send(new AdminMail($checkout));
        
        $old_cart = Cart::where('user_id', $user->id);
        $old_cart->delete();
        if ($request->payment_method == 'online') {
            $sslc = new SslCommerzNotification();
            $payment_options = $sslc->makePayment($post_data, 'hosted');

            if (!is_array($payment_options)) {
                print_r($payment_options);
                $payment_options = array();
            }
        } else {
            return redirect()->route('home')->with('message', 'Order has been placed!');
        }
    }
    public function success()
    {
        return redirect()->route('home')->with('message', 'Order has been placed!');
    }
    public function fail()
    {
        //
    }
    public function cancel()
    {
        //
    }
}
