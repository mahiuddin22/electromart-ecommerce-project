<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\OrderHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index()
    {
        return view('adminpanel.admin.login');
    }

    public function login(Request $request)
    {
        $data = $request->all();
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('message', 'Invalid Credentials');
        }
    }

    public function myAcocunt(){
        $user = User::where('id', auth()->user()->id)->first();
        return view('frontpanel.account.index',compact('user'));
    }

    public function userEdit(){
        $user = User::where('id', auth()->user()->id)->first();
        return view('frontpanel.account.edit',compact('user'));
    }

    public function userUpdate(Request $request, $id){
        $user = User::where('id', $id)->first();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->mobile = $request->mobile;

        if($request->password != null){
            $user->password = Hash::make($request->password);
        }

        $image = $request->file('image');
        if (isset($image)) {
            $currendate = Carbon::now()->toDateString();
            $imagename = $currendate . '-' . uniqid() . '.' . $image->getClientOriginalName();
            if (!file_exists('public/uploads/user')) {
                mkdir('public/uploads/user', 0777, true);
            }
            if (file_exists('public/uploads/user/' . $user->image)) {
                unlink('public/uploads/user/' . $user->image);
            }
            $image->move('public/uploads/user', $imagename);
        } else {
            $imagename = $user->image;
        }
        $user->image = $imagename;
        $user->save();
        return redirect()->route('user.account')->with('message','Information Successfully Updated');
    }

    public function myOders(Request $request){

        $order_date = $request->order_date;
        $to_date   = $request->to_date;
        $order_no  = $request->order_no;

        $checkouts = Checkout::where('user_id', auth()->user()->id);
        if($order_date != null){
            $checkouts = $checkouts->whereDate('created_at', $order_date);
        }
        if($order_no != null){
            $checkouts = $checkouts->where('order_no', $order_no);
        }

        $checkouts = $checkouts->orderBy('id','DESC')->paginate(10);

        return view('frontpanel.orders.my_orders', compact('checkouts'));
    }
    public function orderDetails($id){
        $checkout = Checkout::where('id', $id)->first();
        $user = User::where('id', $checkout->user_id)->first();
        $orders = OrderHistory::where('user_id',$checkout->user_id)->where('checkout_id', $id)->get();
        return view('frontpanel.orders.order_details', compact('orders','checkout','user'));
    }
}
