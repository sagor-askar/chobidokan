<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\OrderDetails;
use App\Models\Project;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

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

    public function orderHistory()
    {
        $orderHistoryProjects = Project::with(['orderDetails','order'])
            ->where('status', '!=',1)
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('frontend.user.order-history', compact('orderHistoryProjects'));
    }

    public function manageProfile()
    {
        $user = User::findOrFail( Auth::id());
        return view('frontend.user.manageProfile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $data = $request->except('image');
        $user->update($data);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/user/'), $filename);
            $user->image = 'uploads/user/' . $filename;
            $user->save();
        }

        return redirect()->back()->with('success', 'User Profile Updated Successfully.');
    }


    public function changePassword()
    {
        $user = User::findOrFail(Auth::id());
        return view('frontend.user.changePassword', compact('user'));
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::findOrFail(Auth::id());

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Your current password is incorrect.');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password updated successfully!');
    }
}
