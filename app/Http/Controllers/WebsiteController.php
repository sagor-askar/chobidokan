<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\Project;
use App\Models\ProjectSubmit;
use App\Models\Subscription;
use App\Models\Upload;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WebsiteController extends Controller
{
    // homepage
    public function index()
    {
        $settings = Setting::first();
        $categories = Category::where('status',1)->get();
        $products = Product::where('status', 1)->paginate(10);

        return view('welcome', compact('settings','products','categories'));
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
        $user = Auth::user();
        $projectsQuery = Project::with(['user', 'order', 'subscription'])
            ->withCount([
                'projectSubmits as total_designer' => function ($query) {
                    $query->select(\DB::raw('COUNT(DISTINCT user_id)'));
                },
                'uploads as total_submitted_design'
            ])
            ->where('status', 1)
            ->orderBy('id', 'desc');

        if ($user->role_id == 3) {
            $projectsQuery->where('user_id', $user->id);
        }
        $projects = $projectsQuery->paginate(2);
        $totalProjects = $projects->total();
        return view('frontend.menu.customize', compact('status','categories','projects','totalProjects'));
    }



    // closed customize jobs
    public function closedJobs()
    {
        $status = 0;
        $categories = Category::where('status',1)->get();
        $user = Auth::user();
        $projectsQuery = Project::with(['user', 'order', 'subscription'])
            ->withCount([
                'projectSubmits as total_designer' => function ($query) {
                    $query->select(\DB::raw('COUNT(DISTINCT user_id)'));
                },
                'uploads as total_submitted_design'
            ])
            ->where('status', 2)
            ->orderBy('id', 'desc');
        if ($user->role_id == 3) {
            $projectsQuery->where('user_id', $user->id);
        }
        $projects = $projectsQuery->paginate(2);
        $totalProjects = $projects->total();
        return view('frontend.menu.closedJobs',compact('status','categories','projects','totalProjects'));
    }

    // submission guideline
    public function guidelines()
    {
        return view('frontend.menu.submissionGuideline');
    }


    // user profile - public view
    public function designerProfile($id)
    {
        $user = User::findOrFail($id);

        $uploads = Upload::with(['projectSubmits', 'project'])
            ->whereHas('projectSubmits', function ($q) use ($id) {
                $q->where('user_id', $id);
            })
            ->paginate(6);
        $totalSubmit = $uploads->total();
        $totalProject = ProjectSubmit::where('user_id', $id)
            ->distinct('project_id')
            ->count('project_id');

        return view('frontend.profiles.designerProfile', compact(   'user','uploads','totalProject','totalSubmit'));
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

        $user = Auth::user();
        $query = Project::with(['user', 'order', 'subscription'])
            ->withCount([
                'projectSubmits as total_designer' => function ($q) {
                    $q->select(\DB::raw('COUNT(DISTINCT user_id)'));
                },
                'uploads as total_submitted_design'
            ]);

        if ($user->role_id == 3) {
            $query->where('user_id', $user->id); // 🔹 user logic
        }

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

        $projects = $query->paginate(2);
        $totalProjects = $projects->total();
        $categories = Category::where('status', 1)->get();
        if ($status == 1){
            return view('frontend.menu.customize', compact('status','categories','projects','totalProjects'));
        }else{
            return view('frontend.menu.closedJobs', compact('status','categories','projects','totalProjects'));
        }
    }

    // image view all page
    public function viewAll()
    {
        return view('viewAll');
    }


}
