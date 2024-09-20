<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id','DESC')->paginate(15);
        return view('adminpanel.category.index', compact('categories'));
    }

    public function create()
    {
        return view('adminpanel.category.create');
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
            if (!file_exists('public/uploads/category')) {
                mkdir('public/uploads/category', 0777, true);
            }
            $image->move('public/uploads/category', $imagename);
        } else {
            $imagename = 'default.png';
        }

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->image = $imagename;
        $category->save();
        return redirect()->route('category')->with('message', 'Data added successfully');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('adminpanel.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [

            'name' => 'required|string',
        ]);

        $category = Category::findOrFail($id);

        $image = $request->file('image');
        if (isset($image)) {
            $currendate = Carbon::now()->toDateString();
            $imagename = $currendate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('public/uploads/category')) {
                mkdir('public/uploads/category', 0777, true);
            }
            if (file_exists('public/uploads/category/' . $category->image)) {
                unlink('public/uploads/category/' . $category->image);
            }
            $image->move('public/uploads/category', $imagename);
        } else {
            $imagename = $category->image;
        }

        $category->name = $request->name;
        $category->image = $imagename;
        $category->save();
        return redirect()->route('category')->with('message', 'Data updated successfully');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if (file_exists('public/uploads/category/' . $category->image)) {
            unlink('public/uploads/category/' . $category->image);
        }
        $category->delete();
        return redirect()->back()->with('message', 'Data deleted successfully');
    }
}
