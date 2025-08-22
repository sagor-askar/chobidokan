<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Project;
use App\Models\Subscription;
use App\Models\User;
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
        $status = 1;
        $categories = Category::where('status',1)->get();
        $projects = Project::with(['order', 'subscription'])->where('status', 1)->get();

        return view('frontend.menu.customize',compact('status','categories','projects'));
    }






    // closed customize jobs
    public function closedJobs()
    {
        $status = 0;
        $categories = Category::where('status',1)->get();
        $projects = Project::with(['order', 'subscription'])->where('status', 2)->get();

        return view('frontend.menu.closedJobs',compact('status','categories','projects'));
    }

    // submission guideline
    public function guidelines()
    {
        return view('frontend.menu.submissionGuideline');
    }

    // user's profile
    public function designerProfile($id)
    {
        $user = User::find($id);
        return view('frontend.profiles.userProfile',compact('user'));
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

    public function CustomJobSearch(Request $request)
    {

        $search      = $request->query('search');
        $category_id = $request->query('category_id');
        $status      = (int)$request->query('status');
        $query = Project::with(['order', 'subscription']);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('project_description', 'like', "%{$search}%");
            });
        }
        if ($category_id) {
            $query->where('category_id', $category_id);
        }
        if ($status !== null) {
            $query->where('status', $status);
        }
        $projects = $query->get();
        $categories = Category::where('status',1)->get();
        if ($status == 1){
            return view('frontend.menu.customize',compact('status','categories','projects'));
        }else{
            return view('frontend.menu.closedJobs',compact('status','categories','projects'));
        }


    }


}
