<?php

namespace App\Http\Controllers;

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
