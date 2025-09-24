<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Project;
use App\Models\ProjectSubmit;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignerController extends Controller
{


    public function dashboard()
    {
        $user = Auth::user();
        return view('frontend.seller.dashboard',compact('user'));
    }

    public function about($id)
    {
        $user = User::findOrFail($id);
        return view('frontend.seller.about', compact('user'));
    }

//    public function submittedWorks($id)
//    {
//        $user = User::findOrFail($id);
//        $uploads = Upload::with(['projectSubmit', 'project'])
//            ->whereHas('projectSubmit', fn($q) => $q->where('user_id', $id))
//            ->paginate(6);
//        return view('frontend.profiles.tabs.submittedWorks', compact('user', 'uploads'));
//    }


    public function orders()
    {
        $orderProjects = Project::with(['projectSubmits', 'uploads'])
            ->where('status', 1)
            ->whereHas('projectSubmits', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->whereHas('uploads', function ($upload) {
                $upload->where('status', 1)
                    ->whereColumn('uploads.project_id', 'projects.id')
                    ->whereIn('uploads.project_submit_id', function ($sub) {
                        $sub->select('id')
                            ->from('project_submits')
                            ->whereColumn('project_submits.project_id', 'projects.id')
                            ->where('project_submits.user_id', Auth::id());
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('frontend.seller.orders', compact('orderProjects'));
    }

    public function orderDelivery($id)
    {
       $project = Project::find($id);
        return view('frontend.seller.order-delivery',compact('project'));
    }

    public function orderHistory()
    {
        $orderHistories = Project::with('projectSubmits')
            ->where('status', 2)
            ->whereHas('projectSubmits', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->orderBy('created_at', 'desc')
            ->paginate(1);
        return view('frontend.seller.order-history',compact('orderHistories'));
    }


    public function manageProfile($id)
    {
        $user = User::findOrFail($id);
        return view('frontend.seller.manageProfile', compact('user'));
    }

    public function changePassword($id)
    {
        $user = User::findOrFail($id);
        return view('frontend.seller.changePassword', compact('user'));
    }

}
