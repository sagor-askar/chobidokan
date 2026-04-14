<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Project;
use App\Models\ProjectSubmit;
use App\Models\Subscription;
use App\Models\SubscriptionDownloadProduct;
use App\Models\SubscriptionPurchase;
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
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class WebsiteController extends Controller
{
    // homepage
    public function index()
    {
        $settings = Setting::first();
        $categories = Category::where('type',1)->where('status',1)->get();

        // Category wise latest product
        $products = Product::where('type',1)
            ->where('status',1)
            ->whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                    ->from('products')
                    ->where('status',1)
                    ->where('type',1)
                    ->groupBy('category_id');
            })
            ->latest()
            ->paginate(10);

        $allTags = collect();
        $tagProducts = Product::latest()->where('status', 1)->get();

        $tagProducts->each(function ($product) use (&$allTags) {
            $tags = json_decode($product->tags, true) ?? [];
            $allTags = $allTags->merge($tags);
        });

        $uniqueTags = $allTags->unique()->values();

        return view('welcome', compact('settings','products','categories','uniqueTags'));
    }

    // custom request
    public function customRequest()
    {
        $categories = Category::where("type",2)->where('status',1)->get();
        $subscriptions = Subscription::where('type',2)->where('status',1)->get();
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
        $categories = Category::where("type",2)->where('status',1)->get();
        $user = Auth::user();
        $projectsQuery = Project::with(['user', 'order', 'subscription'])
            ->withCount([
                'projectSubmit as total_designer' => function ($query) {
                    $query->select(\DB::raw('COUNT(DISTINCT designer_id)'));
                },
                'uploads as total_submitted_design'
            ])
            ->where('status', 1)
            ->orderBy('id', 'desc');

        if ($user && $user->role_id == 3) {
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
        $categories = Category::where("type",2)->where('status',1)->get();
        $user = Auth::user();
        $projectsQuery = Project::with(['user', 'order', 'subscription'])
            ->withCount([
                'projectSubmit as total_designer' => function ($query) {
                    $query->select(\DB::raw('COUNT(DISTINCT designer_id)'));
                },
                'uploads as total_submitted_design'
            ])
            ->where('status', 2)
            ->orderBy('id', 'desc');
        if ($user && $user->role_id == 3) {
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
        $uploads = Upload::with(['projectSubmit', 'project'])
            ->whereHas('projectSubmit', function ($q) use ($id) {
                $q->where('designer_id', $id);
            })
            ->paginate(6);
        $totalSubmit = $uploads->total();
        $totalProject = ProjectSubmit::where('designer_id', $id)
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
        $subscriptions = Subscription::where('type',1)->where('status',1)->get();
        return view('frontend.footer.pricing',compact('subscriptions'));
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
                'projectSubmit as total_designer' => function ($q) {
                    $q->select(\DB::raw('COUNT(DISTINCT designer_id)'));
                },
                'uploads as total_submitted_design'
            ]);

        if ($user && $user->role_id == 3) {
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
        $categories = Category::where("type",2)->where('status', 1)->get();
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

    // view image details page
    public function viewDetails()
    {
        return view('viewDetails');
    }

    // all videos
    public function allVideos()
    {
        return view('allVideos');
    }

    // view video details
    public function viewVideo()
    {
        return view('viewVideo');
    }

    public function search(Request $request)
    {
        $type = $request->query('type');
        $search = $request->query('search');
        $products = Product::where('status', 1)
            ->where('type', $type)
            ->where(function($query) use ($search) {

                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('tags', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");

                $query->orWhereHas('category', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });

                $query->orWhereHas('designer', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->whereIn('id', function ($query) use ($type, $search) {

                $query->selectRaw('MAX(id)')
                    ->from('products')
                    ->where('status', 1)
                    ->where('type', $type)
                    ->where(function($q) use ($search) {

                        $q->where('title', 'like', "%{$search}%")
                            ->orWhere('tags', 'like', "%{$search}%")
                            ->orWhere('description', 'like', "%{$search}%");
                    })
                    ->groupBy('category_id');
            })
            ->latest()
            ->paginate(8);
        //tags
        $allTags = collect();
        $tagProducts = Product::where('status', 1)->get();

        $tagProducts->each(function ($product) use (&$allTags) {
            $tags = json_decode($product->tags, true) ?? [];
            $allTags = $allTags->merge($tags);
        });
        $uniqueTags = $allTags->unique()->values();

        if ($type == 1) {
            return view('frontend.menu.image', compact('products', 'type','search','uniqueTags'));
        }else{
            return view('frontend.menu.videos', compact('products', 'type','search','uniqueTags'));
        }
    }


    public function tagProduct($tag)
    {
         $products = Product::with('designer')
                ->where(function ($query) use ($tag) {
                    $query->whereJsonContains('tags', $tag);
                })
                ->where('status', 1)
                ->paginate(8);
        //tags
        $allTags = collect();
        $tagProducts = Product::where('status', 1)
                      ->where(function ($query) use ($tag) {
                          $query->whereJsonContains('tags', $tag);
                     })
                    ->get();
        $tagProducts->each(function ($product) use (&$allTags) {
            $tags = json_decode($product->tags, true) ?? [];
            $allTags = $allTags->merge($tags);
        });
        $uniqueTags = $allTags->unique()->values();
        return view('frontend.menu.tag-product',compact('tag','products','uniqueTags'));
    }

    public function categoryProduct($id)
    {
        $category = Category::find($id);
        $products = Product::with('designer')
            ->where('status', 1)
            ->where('category_id', $id)
            ->paginate(8);
        //tags
        $allTags = collect();
        $tagProducts = Product::where('status', 1)
            ->where('category_id', $id)
            ->get();
        $tagProducts->each(function ($product) use (&$allTags) {
            $tags = json_decode($product->tags, true) ?? [];
            $allTags = $allTags->merge($tags);
        });
        $uniqueTags = $allTags->unique()->values();
        return view('frontend.menu.category-product',compact('category','products','uniqueTags'));
    }


    public function productDetails($id)
    {
        $product = Product::find($id);
        $category = Category::find($product->category_id);

        $subscriptions = Subscription::where('type',1)->where('status',1)->get();

        //tags
        $allTags = collect();
        $tagProducts = Product::where('status', 1)
            ->where('category_id', $product->category_id)
            ->get();
        $tagProducts->each(function ($product) use (&$allTags) {
            $tags = json_decode($product->tags, true) ?? [];
            $allTags = $allTags->merge($tags);
        });
        $uniqueTags = $allTags->unique()->values();


        $similarProducts = Product::where('status', 1)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('type', $product->type)
            ->latest()
            ->take(12)
            ->get();


        $hasAccess = false;
        $isPayment = null;
        $isActiveSubscription = null;

        $authUser = Auth::check() ? Auth::user() : null;
        if ($authUser) {
            $isPayment = Payment::where('product_id', $product->id)
                                ->where('user_id', $authUser->id)
                                ->first();
            $isActiveSubscription = SubscriptionPurchase::where('user_id', $authUser->id)
                                ->where('status', 1)
                                ->first();
        }
        $hasAccess = ($isPayment !== null) || ($isActiveSubscription !== null);

        if ($product->type == 1) {
            return view('frontend.menu.imageDetails',compact('hasAccess','isPayment','isActiveSubscription','subscriptions','category','product','uniqueTags','similarProducts'));
        }else{
            return view('frontend.menu.videoDetails',compact('hasAccess','isPayment','isActiveSubscription','subscriptions','category','product','uniqueTags','similarProducts'));
        }

    }


    public function productFileView($id)
    {
        $product = Product::findOrFail($id);

        $path = storage_path('app/' . $product->file_path);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path, [
            'Content-Type' => $product->file_type,
            'Content-Disposition' => 'inline'
        ]);
    }


    public function productImageDownload($id)
    {
        $id = base64_decode($id);
        if (!auth()->check()) {
            abort(403, 'Unauthorized');
        }

        $product = Product::findOrFail($id);


          $hasAccess = false;
          $payment = Payment::where('product_id', $id)
            ->where('user_id', auth()->id())
            ->first();

            $isActiveSubscription = SubscriptionPurchase::where('user_id', auth()->id())
                ->where('status', 1)
                ->first();
        $hasAccess = ($payment !== null) || ($isActiveSubscription !== null);

        if (!$hasAccess) {
            abort(403, 'You did not purchase this product.');
        }

        // Count only once
         if ($payment !== null){
             if ($payment->is_counted == 0) {
                $payment->update(['is_counted' => 1]);
                $product->increment('total_download');
              }
         }
          if ($isActiveSubscription !== null){
              $subscriptionDownloadProduct = SubscriptionDownloadProduct::where('subscription_purchase_id', $isActiveSubscription->id)->where('product_id', $id)->first();
               $paymentData = Payment::findOrFail($isActiveSubscription->payment_id);
              if ($subscriptionDownloadProduct == null) {
                  if ($paymentData->is_counted == 0) {
                      $paymentData->update(['is_counted' => 1]);

                  }
                  if ($isActiveSubscription->total_purchase < $isActiveSubscription->total_image) {
                       SubscriptionDownloadProduct::create([
                          'product_id'      => $product->id,
                          'subscription_purchase_id' => $isActiveSubscription->id,
                      ]);
                      $isActiveSubscription->increment('total_purchase');
                      $product->increment('total_download');
                  }
                  if ($isActiveSubscription->total_purchase == $isActiveSubscription->total_image) {
                      $isActiveSubscription->update(['status' => 0]);
                  }
              }
         }

        $filePath = storage_path('app/' . $product->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        return response()->download(
            $filePath,
            $product->file_name,
            ['Content-Type' => $product->file_type]
        );
    }

    public function serveVideo($id)
    {
        $product = Product::findOrFail($id);

        if (!Storage::disk('local')->exists($product->file_path)) {
            abort(404);
        }
        $path = storage_path('app/' . $product->file_path);

        return response()->file($path, [
            'Content-Type' => $product->file_type,
            'Accept-Ranges' => 'bytes',
            'Content-Disposition' => 'inline'
        ]);
    }

    public function downloadVideo($id)
    {
        $id = base64_decode($id);

        if (!auth()->check()) {
            abort(403, 'Unauthorized');
        }
        $product = Product::findOrFail($id);

        $hasAccess = false;
        $payment = Payment::where('product_id', $id)
            ->where('user_id', auth()->id())
            ->first();

        $isActiveSubscription = SubscriptionPurchase::where('user_id', auth()->id())
            ->where('status', 1)
            ->first();
        $hasAccess = ($payment !== null) || ($isActiveSubscription !== null);

        if (!$hasAccess) {
            abort(403, 'You did not purchase this product.');
        }

        // Count only once
        if ($payment !== null){
            if ($payment->is_counted == 0) {
                $payment->update(['is_counted' => 1]);
                $product->increment('total_download');
            }
        }
        if ($isActiveSubscription !== null){
            $subscriptionDownloadProduct = SubscriptionDownloadProduct::where('subscription_purchase_id', $isActiveSubscription->id)->where('product_id', $id)->first();
            $paymentData = Payment::findOrFail($isActiveSubscription->payment_id);
            if ($subscriptionDownloadProduct == null) {
                if ($paymentData->is_counted == 0) {
                    $paymentData->update(['is_counted' => 1]);

                }
                if ($isActiveSubscription->total_purchase < $isActiveSubscription->total_image) {
                    SubscriptionDownloadProduct::create([
                        'product_id'      => $product->id,
                        'subscription_purchase_id' => $isActiveSubscription->id,
                    ]);
                    $isActiveSubscription->increment('total_purchase');
                    $product->increment('total_download');
                }
                if ($isActiveSubscription->total_purchase == $isActiveSubscription->total_image) {
                    $isActiveSubscription->update(['status' => 0]);
                }
            }
        }

        if (!Storage::disk('local')->exists($product->file_path)) {
            abort(404);
        }

        $path = storage_path('app/' . $product->file_path);

        return response()->download($path, $product->title . '.' . pathinfo($product->file_path, PATHINFO_EXTENSION));
    }





}
