<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\PrivacyPolicy;
use App\Models\Terms;
use Image;

class SettingController extends Controller
{
    // website settings
    public function setting()
    {
        $settings =  Setting::orderBy('id','DESC')->first();
        return view('admin.settings.index',compact('settings'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $setting = Setting::orderBy('id','DESC')->first();
        if ($setting){
            $setting->update($data);
        }else{
            $setting = Setting::create($data);
        }

        if ($request->hasFile('logo')) {
            if (file_exists(public_path($setting->logo))) {
                unlink(public_path($setting->logo));
            }
            $image = $request->file('logo');
            $imageName = time() . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/settings/' . $imageName);
            // Save Original Image
            Image::make($image)->resize(1825, 953)->save($imagePath);
            $setting->logo = 'uploads/settings/' . $imageName;
            $setting->save();
        }
        return redirect()->back()->with('success', 'Settings Updated Successfully.');
    }

    // privacy policy
    public function privacyPolicy()
    {
        $privcyPolicy =  PrivacyPolicy::orderBy('id','DESC')->first();
        return view('admin.privacy.index',compact('privcyPolicy'));
    }

    public function privacyPolicyStore(Request $request)
    {
        $data = $request->all();

        $privcyPolicy = PrivacyPolicy::orderBy('id','DESC')->first();
        if ($privcyPolicy){
            $privcyPolicy->update($data);
        }else{
            PrivacyPolicy::create($data);
        }

        return redirect()->back()->with('success', 'Privacy & Policy Updated Successfully.');;
    }

    // terms of use
    public function termsOfUse()
    {
        $termsOfUse =  Terms::orderBy('id','DESC')->first();
        return view('admin.terms.index',compact('termsOfUse'));
    }

    public function termsOfUseStore(Request $request)
    {
        $data = $request->all();

        $termsOfUse = Terms::orderBy('id','DESC')->first();
        if ($termsOfUse){
            $termsOfUse->update($data);
        }else{
            Terms::create($data);
        }

        return redirect()->back()->with('success', 'Terms of Uses Updated Successfully.');;
    }
}
