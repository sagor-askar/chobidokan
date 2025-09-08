<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use App\Models\User;
use Illuminate\Http\Request;

class DesignerController extends Controller
{

    public function about($id)
    {
        $user = User::findOrFail($id);
        return view('frontend.profiles.about', compact('user'));
    }

//    public function submittedWorks($id)
//    {
//        $user = User::findOrFail($id);
//        $uploads = Upload::with(['projectSubmit', 'project'])
//            ->whereHas('projectSubmit', fn($q) => $q->where('user_id', $id))
//            ->paginate(6);
//        return view('frontend.profiles.tabs.submittedWorks', compact('user', 'uploads'));
//    }

}
