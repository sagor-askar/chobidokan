<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\PrivacyPolicy;
use App\Models\Terms;
use App\Models\Licencing;
use App\Models\SearchTips;
use App\Models\Technical;
use App\Models\ImgResearch;
use App\Models\InfoSetup;
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

    // Licencing Info
    public function licencing()
    {
        $licencing =  Licencing::orderBy('id','DESC')->first();
        return view('admin.licencing.index',compact('licencing'));
    }

    public function licencingStore(Request $request)
    {
        $data = $request->all();

        $licencing = Licencing::orderBy('id','DESC')->first();
        if ($licencing){
            $licencing->update($data);
        }else{
            Licencing::create($data);
        }

        return redirect()->back()->with('success', 'Licencing Info Updated Successfully.');;
    }

    // Search Tips
    public function searchTips()
    {
        $searchTips =  SearchTips::orderBy('id','DESC')->first();
        return view('admin.searchTips.index',compact('searchTips'));
    }

    public function searchTipsStore(Request $request)
    {
        $data = $request->all();

        $searchTips = SearchTips::orderBy('id','DESC')->first();
        if ($searchTips){
            $searchTips->update($data);
        }else{
            SearchTips::create($data);
        }

        return redirect()->back()->with('success', 'Search Tips Updated Successfully.');;
    }

    // Technical Info
    public function technicalInfo()
    {
        $technicalInfo =  Technical::orderBy('id','DESC')->first();
        return view('admin.technical.index',compact('technicalInfo'));
    }

    public function technicalInfoStore(Request $request)
    {
        $data = $request->all();

        $technicalInfo = Technical::orderBy('id','DESC')->first();
        if ($technicalInfo){
            $technicalInfo->update($data);
        }else{
            Technical::create($data);
        }

        return redirect()->back()->with('success', 'Technical Info Updated Successfully.');;
    }

    // Research Image
    public function imgResearch()
    {
        $imgResearch =  ImgResearch::orderBy('id','DESC')->first();
        return view('admin.imageResearch.index',compact('imgResearch'));
    }

    public function imgResearchStore(Request $request)
    {
        $data = $request->all();

        $imgResearch = ImgResearch::orderBy('id','DESC')->first();
        if ($imgResearch){
            $imgResearch->update($data);
        }else{
            ImgResearch::create($data);
        }

        return redirect()->back()->with('success', 'Research Info Updated Successfully.');;
    }

    // Info Setup
    public function infoSetup()
    {
        $infoSetup =  InfoSetup::orderBy('id','DESC')->first();
        return view('admin.info.index',compact('infoSetup'));
    }

    public function infoSetupStore(Request $request)
    {
        $data = $request->all();

        $infoSetup = InfoSetup::orderBy('id','DESC')->first();
        if ($infoSetup){
            $infoSetup->update($data);
        }else{
            InfoSetup::create($data);
        }

        return redirect()->back()->with('success', 'Info Updated Successfully.');;
    }
}
