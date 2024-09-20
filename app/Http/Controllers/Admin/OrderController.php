<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderApprovalMail;
use App\Models\Checkout;
use App\Models\OrderHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function pending(Request $request){
        $order_date = $request->order_date;
        $to_date   = $request->to_date;
        $order_no  = $request->order_no;

        $checkouts = Checkout::orderBy('id','DESC');
        if($order_date != null){
            $checkouts = $checkouts->whereDate('created_at', $order_date);
        }
        if($order_no != null){
            $checkouts = $checkouts->where('order_no', $order_no);
        }

        $checkouts = $checkouts->paginate(20);

        return view('adminpanel.orders.index', compact('checkouts'));
    }
    public function show($id){
        $checkout = Checkout::where('id', $id)->first();
        $user = User::where('id', $checkout->user_id)->first();
        $orders = OrderHistory::where('user_id',$checkout->user_id)->where('checkout_id', $id)->get();
        return view('adminpanel.orders.order_details', compact('orders','checkout','user'));
    }
    public function approval($id){
        $checkout = Checkout::where('id', $id)->first();
        $user = User::where('id', $checkout->user_id)->first();
        $checkout->status = 1;
        $checkout->save();

        $subject = "Order Successfully Confimed";
        Mail::to($user->email)->send(new OrderApprovalMail($subject));
        
        return redirect()->route('admin.order.pending')->with('message', 'Order Approved successfully');
    }
} 
