<?php

namespace App\Http\Controllers\Frontpanel;

use App\Http\Controllers\Controller;
use App\Models\Aboutus;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $products = Product::where('featured', '=', 'on')->get();
        $d_product = Product::where('discount', '!=', 'null')->get();
        return view('frontpanel.home', compact('products', 'd_product'));
    }
    public function ShopPage()
    {
        $categories = Category::with('subcategories')->get();
        $brands = Brand::where('status', 1)->get();
        $products = Product::orderBy('id', 'DESC')->paginate(12);
        $i = 1;
        return view('frontpanel.shop', compact('categories', 'products', 'brands', 'i'));
    }

    public function AboutUs()
    {
        $aboutus = Aboutus::where('id', 1)->first();
        return view('frontpanel.aboutus', compact('aboutus'));
    }

    public function ContactUs()
    {
        return view('frontpanel.contactus');
    }

    public function ContactStore(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'subject' => ['required'],
            'description' => ['required'],
        ]);
        $contact = new Contact();
        $contact->name        = $request->name;
        $contact->email       = $request->email;
        $contact->subject     = $request->subject;
        $contact->description = $request->description;
        $contact->save();
        return redirect()->back()->with('message', 'Success! We will contact you soon');
    }
}
