<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    public function index()
    {
        $wishlists = Wishlist::with('product')
            ->where('user_id',auth()->id())
            ->get();

        return view('frontend.menu.wishlist',compact('wishlists'));
    }

    public function toggle($id)
    {
        $user = auth()->user();

        $wishlist = Wishlist::where('user_id',$user->id)
            ->where('product_id',$id)
            ->first();

        if($wishlist){
            $wishlist->delete();
            $status = 'removed';
            $message = 'Removed from wishlist';
        }else{
            Wishlist::create([
                'user_id'=>$user->id,
                'product_id'=>$id
            ]);
            $status = 'added';
            $message = 'Added to wishlist successfully';
        }

        $count = Wishlist::where('user_id',$user->id)->count();

        return response()->json([
            'status'=>$status,
            'count'=>$count,
            'message'=>$message
        ]);
    }

    public function remove($id)
    {
        Wishlist::where('id',$id)
            ->where('user_id',auth()->id())
            ->delete();
        return back()->with('warning','Removed successfully');
    }
}
