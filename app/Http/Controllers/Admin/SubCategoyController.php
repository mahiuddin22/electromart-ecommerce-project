<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubCategoyController extends Controller
{
    public function index()
    {
        $subcategories = SubCategory::paginate(10);
        $categories = Category::all();
        return view('adminpanel.subcategory.index', compact('subcategories','categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('adminpanel.subcategory.create',compact('categories'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string',
            'category_id' => 'required',
            'image' => 'required',
        ]);

        $image = $request->file('image');
        if (isset($image)) {
            $currendate = Carbon::now()->toDateString();
            $imagename = $currendate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('public/uploads/subcategory')) {
                mkdir('public/uploads/subcategory', 0777, true);
            }
            $image->move('public/uploads/subcategory', $imagename);
        } else {
            $imagename = 'default.png';
        }

        $subcategory = new SubCategory();
        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;
        $subcategory->description = $request->description;
        $subcategory->image = $imagename;
        $subcategory->save();
        return redirect()->route('subcategory')->with('message', 'Data added successfully');
    }

    public function edit($id)
    {
        $categories = Category::orderBy('id','DESC')->paginate(15);
        $subcategory = SubCategory::findOrFail($id);
        return view('adminpanel.subcategory.edit', compact('subcategory','categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [

            'name' => 'required|string',
        ]);

        $subcategory = SubCategory::findOrFail($id);

        $image = $request->file('image');
        if (isset($image)) {
            $currendate = Carbon::now()->toDateString();
            $imagename = $currendate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('public/uploads/subcategory')) {
                mkdir('public/uploads/subcategory', 0777, true);
            }
            if (file_exists('public/uploads/subcategory/' . $subcategory->image)) {
                unlink('public/uploads/subcategory/' . $subcategory->image);
            }
            $image->move('public/uploads/subcategory', $imagename);
        } else {
            $imagename = $subcategory->image;
        }

        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;
        $subcategory->description = $request->description;
        $subcategory->image = $imagename;
        $subcategory->save();
        return redirect()->route('subcategory')->with('message', 'Data updated successfully');
    }

    public function destroy($id)
    {
        $subcategory = SubCategory::findOrFail($id);

        if (file_exists('public/uploads/subcategory/' . $subcategory->image)) {
            unlink('public/uploads/subcategory/' . $subcategory->image);
        }
        $subcategory->delete();
        return redirect()->back()->with('message', 'Data deleted successfully');
    }
}
