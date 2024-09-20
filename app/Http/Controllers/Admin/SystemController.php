<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aboutus;
use App\Models\SiteSettings;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    // About Us Settings Start From Here------------------------------

    public function about()
    {
        $aboutus = Aboutus::where('id',1)->first();
        return view('adminpanel.aboutus.about', compact('aboutus'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string',
        ]);

        $aboutus = Aboutus::findOrFail($id);

        $image = $request->file('image');
        if (isset($image)) {
            $currendate = Carbon::now()->toDateString();
            $imagename = $currendate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('public/uploads/system')) {
                mkdir('public/uploads/system', 0777, true);
            }
            if (file_exists('public/uploads/system/' . $aboutus->image)) {
                unlink('public/uploads/system/' . $aboutus->image);
            }
            $image->move('public/uploads/system', $imagename);
        } else {
            $imagename = $aboutus->image;
        }

        $aboutus->title       = $request->title;
        $aboutus->description = $request->description;
        $aboutus->image       = $imagename;
        $aboutus->save();
        return redirect()->back()->with('message', 'Data updated successfully');
    }

    // Site Settings Start From Here------------------------------

    public function siteSettings(){
        $settings = SiteSettings::where('id',1)->first();
        return view('adminpanel.sitesettings.settings', compact('settings'));
    }

    public function siteUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'phone' => 'required',
            'email' => 'required'
        ]);
        $settings = SiteSettings::findOrFail($id);

        $image = $request->file('logo');
        if (isset($image)) {
            $currendate = Carbon::now()->toDateString();
            $imagename = $currendate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('public/uploads/system')) {
                mkdir('public/uploads/system', 0777, true);
            }
            if (file_exists('public/uploads/system/' . $settings->logo)) {
                unlink('public/uploads/system/' . $settings->logo);
            }
            $image->move('public/uploads/system', $imagename);
        } else {
            $imagename = $settings->logo;
        }

        $settings->logo        = $imagename;
        $settings->description = $request->description;
        $settings->address     = $request->address;
        $settings->phone       = $request->phone;
        $settings->alt_phone   = $request->alt_phone;
        $settings->email       = $request->email;
        $settings->copyright   = $request->copyright;
        $settings->madeby      = $request->madeby;
        $settings->save();
        return redirect()->back()->with('message', 'Data updated successfully');
    }
}
