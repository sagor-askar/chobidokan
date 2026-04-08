<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Payment;
use App\Models\Product;
use App\Models\TempPayment;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use ZipStream\ZipStream;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{


    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id',auth()->id())
            ->whereDoesntHave('product.payment', function($q){
                $q->where('user_id',auth()->id());
            })
            ->get();

        $total = $carts->sum(fn($item)=>$item->product->price);

        return view('frontend.menu.cart',compact('carts','total'));
    }

    public function addToCart(Request $request)
    {
        $product_id = $request->product_id;
        $user_id = Auth::id();

        $exists = Cart::where('product_id', $product_id)
            ->where('user_id', $user_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('warning','Already Added to Cart!');
        }

        // wishlist থেকে remove করবে যদি থাকে
        Wishlist::where('product_id', $product_id)
            ->where('user_id', $user_id)
            ->delete();

        Cart::create([
            'product_id' => $product_id,
            'user_id'    => $user_id
        ]);

        return redirect()->back()->with('success','Product moved to cart');
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
            Wishlist::where('user_id',auth()->id())
                ->where('product_id',$product_id)
                ->delete();
        }
        return redirect()->route('cart.index')
            ->with('success','Product moved to cart');
    }


    public function remove($id)
    {
        Cart::where('id',$id)
            ->where('user_id',auth()->id())
            ->delete();

        $count = Cart::where('user_id',auth()->id())->count();

        return response()->json([
            'count'=>$count
        ]);
    }

    public function cartDownloadZip($tran_id)
    {
        $tempPayment = TempPayment::where('tran_id', $tran_id)->firstOrFail();
        $product_ids = json_decode($tempPayment->product_ids, true);

        $files = [];
        foreach ($product_ids as $id) {
            $product = Product::find($id);
            if ($product) {
                $files[] = storage_path('app/' . $product->file_path);
            }
        }

        $zip = new ZipStream(
            outputName: "ChobiDokan-products.zip"
        );

        foreach ($files as $file) {
            if (file_exists($file)) {
                $zip->addFileFromPath(basename($file), $file);
            }
        }

        $zip->finish();


  //    total Download count
     foreach ($product_ids as $id) {
         $product = Product::find($id);
         $payment = Payment::where('product_id', $id)
            ->where('user_id', $tempPayment->user_id)
            ->first();
        if ($payment){
            if ($payment->is_counted == 0) {
                $payment->update(['is_counted' => 1]);
                $product->increment('total_download');
            }
        }
     }

        TempPayment::where('tran_id', $tran_id)->delete();
    }
}
