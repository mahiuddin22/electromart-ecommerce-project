<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::orderBy('id','DESC')->paginate(15);
        return view('adminpanel.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('discount','!=', null)->get();
        return view('adminpanel.slider.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'product_id' => 'required',
            'status' => 'required',
            'image' => 'required',
        ]);

        $image = $request->file('image');
        if (isset($image)) {
            $currendate = Carbon::now()->toDateString();
            $imagename = $currendate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('public/uploads/slider')) {
                mkdir('public/uploads/slider', 0777, true);
            }
            $image->move('public/uploads/slider', $imagename);
        } else {
            $imagename = 'default.png';
        }

        $slider = new Slider();
        $slider->name = $request->name;
        $slider->product_id = $request->product_id;
        $slider->image = $imagename;
        if ($request->status == 1) {
            $slider->status = 1;
        } else {
            $slider->status = 0;
        }
        $slider->save();
        return redirect()->route('slider')->with('message', 'Data added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        $products = Product::where('discount','!=', null)->get();
        return view('adminpanel.slider.edit', compact('slider','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [

            'name' => 'required|string',
            'product_id' => 'required',
            'status' => 'required',
        ]);

        $slider = Slider::findOrFail($id);

        $image = $request->file('image');
        if (isset($image)) {
            $currendate = Carbon::now()->toDateString();
            $imagename = $currendate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('public/uploads/slider')) {
                mkdir('public/uploads/slider', 0777, true);
            }
            if (file_exists('public/uploads/slider/' . $slider->image)) {
                unlink('public/uploads/slider/' . $slider->image);
            }
            $image->move('public/uploads/slider', $imagename);
        } else {
            $imagename = $slider->image;
        }

        $slider->name        = $request->name;
        $slider->product_id  = $request->product_id;
        if ($request->status == 1) {
            $slider->status  = 1;
        } else {
            $slider->status  = 0;
        }
        $slider->image       = $imagename;
        $slider->save();
        return redirect()->route('slider')->with('message', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        if (file_exists('public/uploads/slider/' . $slider->image)) {
            unlink('public/uploads/slider/' . $slider->image);
        }
        $slider->delete();
        return redirect()->back()->with('message', 'Data deleted successfully');
    }
}
