<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{


    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id',auth()->id())
            ->get();

        $total = $carts->sum(fn($item)=>$item->product->price);

        return view('frontend.menu.cart',compact('carts','total'));
    }

    public function store(Request $request)
    {
        if(!$request->products){
            return back()->with('error','Select at least one product');
        }

        foreach($request->products as $product_id){

            Cart::firstOrCreate([
                'user_id'=>auth()->id(),
                'product_id'=>$product_id
            ]);
        }

        return redirect()->route('cart.index')
            ->with('success','Added to cart');
    }
}
