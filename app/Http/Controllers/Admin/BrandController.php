<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('id','DESC')->paginate(15);
        return view('adminpanel.brand.index', compact('brands'));
    }

    public function create()
    {
        return view('adminpanel.brand.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string',
            'image' => 'required',
        ]);

        $image = $request->file('image');
        if (isset($image)) {
            $currendate = Carbon::now()->toDateString();
            $imagename = $currendate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('public/uploads/brand')) {
                mkdir('public/uploads/brand', 0777, true);
            }
            $image->move('public/uploads/brand', $imagename);
        } else {
            $imagename = 'default.png';
        }

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->description = $request->description;
        $brand->image = $imagename;
        if ($request->status == 1) {
            $brand->status = 1;
        } else {
            $brand->status = 0;
        }
        $brand->save();
        return redirect()->route('brand')->with('message', 'Data added successfully');
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('adminpanel.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [

            'name' => 'required|string',
        ]);

        $brand = Brand::findOrFail($id);

        $image = $request->file('image');
        if (isset($image)) {
            $currendate = Carbon::now()->toDateString();
            $imagename = $currendate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('public/uploads/brand')) {
                mkdir('public/uploads/brand', 0777, true);
            }
            if (file_exists('public/uploads/brand/' . $brand->image)) {
                unlink('public/uploads/brand/' . $brand->image);
            }
            $image->move('public/uploads/brand', $imagename);
        } else {
            $imagename = $brand->image;
        }

        $brand->name = $request->name;
        $brand->image = $imagename;
        if ($request->status == 1) {
            $brand->status = 1;
        } else {
            $brand->status = 0;
        }
        $brand->save();
        return redirect()->route('brand')->with('message', 'Data updated successfully');
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        if (file_exists('public/uploads/brand/' . $brand->image)) {
            unlink('public/uploads/brand/' . $brand->image);
        }
        $brand->delete();
        return redirect()->back()->with('message', 'Data deleted successfully');
    }
}
