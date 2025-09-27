<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\OrderDetails;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        return view('frontend.user.dashboard',compact('user'));
    }

    public function about($id)
    {
        $user = User::findOrFail($id);
        return view('frontend.user.about', compact('user'));
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
        $orderProjects = Project::with(['orderDetails'])
                        ->where('status', 1)
                         ->where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
        return view('frontend.user.orders', compact('orderProjects'));
    }

    public function submittedOrderFile($id)
    {
        $orderSubmittedFiles = OrderDetails::with(['project','user'])
            ->where('project_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('frontend.user.order-submitted', compact('orderSubmittedFiles'));
    }

    public function projectApprove(Request $request ,$id)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        Comment::create([
            'project_id' => $id,
            'user_id'    => Auth::id(),
            'comment'    => $request->comment,
            'parent_id'  => null,
        ]);

        $project = Project::find($id);
        $project->status = 2;
        $project->save();
        return redirect()->back()->with('success', 'Comment Successfully Sent!');
    }

    public function submissionReject(Request $request ,$id)
    {

            $request->validate([
                'comment' => 'required|string',
            ]);

            Comment::create([
                'project_id' => $id,
                'user_id'    => Auth::id(),
                'comment'    => $request->comment,
                'parent_id'  => null,
            ]);
            return redirect()->back()->with('success', 'Comment Successfully Sent!');

    }

    public function manageProfile($id)
    {
        $user = User::findOrFail($id);
        return view('frontend.user.manageProfile', compact('user'));
    }

    public function changePassword($id)
    {
        $user = User::findOrFail($id);
        return view('frontend.user.changePassword', compact('user'));
    }
}
