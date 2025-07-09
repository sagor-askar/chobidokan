<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Subscription;
use Illuminate\Http\Request;

use App\Models\Faq;
use App\Models\Testimonial;
use App\Models\Setting;
use App\Models\PrivacyPolicy;
use App\Models\Terms;
use App\Models\Licencing;
use App\Models\SearchTips;
use App\Models\InfoSetup;

class WebsiteController extends Controller
{
    // homepage
    public function index()
    {
        $settings = Setting::first();
        return view('welcome', compact('settings'));
    }

    // custom request
    public function customRequest()
    {
        $categories = Category::where('status',1)->get();
        $subscriptions = Subscription::where('status',1)->get();
        return view('frontend.customRequest',compact('categories','subscriptions'));
    }

    // info page
    public function info()
    {
        $infoSetup = InfoSetup::first();
        return view('frontend.menu.info', compact('infoSetup'));
    }

    // customize jobs
    public function customization()
    {
        return view('frontend.menu.customize');
    }

    // customize job details
    public function customizationDetail()
    {
        return view('frontend.menu.customizeDetails');
    }

    // customize job submission
    public function submission()
    {
        return view('frontend.menu.submission');
    }

    // closed customize jobs
    public function closedJobs()
    {
        return view('frontend.menu.closedJobs');
    }

    // submission guideline
    public function guidelines()
    {
        return view('frontend.menu.submissionGuideline');
    }

    // user's profile
    public function designerProfile()
    {
        return view('frontend.profiles.userProfile');
    }

    // signin
    public function signin()
    {
        return view('frontend.auth.signin');
    }

    // signup
    public function signup()
    {
        return view('frontend.auth.signup');
    }

    // uploads
    public function uploadImages()
    {
        return view('frontend.menu.upload');
    }

    // about us
    public function aboutUs()
    {
        return view('frontend.footer.about');
    }

    // testimonial
    public function testimonial()
    {
        return view('frontend.footer.testimonial');
    }

    // image research
    public function imageResearch()
    {
        return view('frontend.footer.imageResearch');
    }

    // pricing table
    public function pricingTable()
    {
        return view('frontend.footer.pricing');
    }

    // licencing
    public function licenceInfo()
    {
        $licencing = Licencing::first();
        return view('frontend.footer.licencing', compact('licencing'));
    }

    // terms of use
    public function termsofUse()
    {
        $terms = Terms::first();
        return view('frontend.footer.termsofuse', compact('terms'));
    }

    // privacy policy
    public function privacyPolicy()
    {
        $privacy = PrivacyPolicy::first();
        return view('frontend.footer.privacypolicy', compact('privacy'));
    }

    // contact us
    public function contactUs()
    {
        $settings = Setting::first();
        return view('frontend.footer.contact', compact('settings'));
    }

    // search tips
    public function searchTips()
    {
        $searchTips = SearchTips::first();
        return view('frontend.footer.searchtips', compact('searchTips'));
    }

    // faq
    public function faqs()
    {
        $faq = Faq::all();
        return view('frontend.footer.faq', compact('faq'));
    }

    // technicals
    public function technicals()
    {
        return view('frontend.footer.technical');
    }

    // seller registration
    public function sellerReg()
    {
        return view('frontend.seller.registration');
    }
    // seller login
    public function sellerLog()
    {
        return view('frontend.seller.login');
    }
    // seller dashboard
    public function sellerDash()
    {
        return view('frontend.seller.dashboard');
    }

}
