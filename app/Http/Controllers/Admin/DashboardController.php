<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Checkout;
use App\Models\Contact;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $category      = Category::count();
        $subcategory   = SubCategory::count();
        $contact       = Contact::where('status', true)->count();
        $product       = Product::where('status', true)->count();
        $order         = Checkout::where('status',0)->count();
        return view('adminpanel.dashboard', compact('category','subcategory','contact','product','order'));
    }

    public function contact(){
        $contacts = Contact::orderBy('id','DESC')->paginate(15);
        return view('adminpanel.contact.index', compact('contacts'));
    }

    public function contactShow($id){
        $contact = Contact::findOrFail($id);
        return view('adminpanel.contact.show', compact('contact'));
    }

    public function changeStatus($id){
        
        $contact = Contact::findOrFail($id);
        if($contact->status == 0){
            $contact->status = 1;
            $contact->save();
            return redirect()->route('contact.info')->with('message','Successfully Marked as Read');
        }else{
            return redirect()->route('contact.info')->with('message','Already Marked as Read');
        }
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
