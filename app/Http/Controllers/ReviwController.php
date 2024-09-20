<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviwController extends Controller
{
    public function index(){
        //
    }
    public function store(Request $request){
        $review = new Review();

        $review->review         = $request->review;
        $review->product_id     = $request->product_id;
        $review->customer_name  = $request->customer_name;
        $review->customer_email = $request->customer_email;
        $review->description    = $request->description;
        $review->save();
        return redirect()->back()->with('message', 'Review Added Successfully');
    }
}
