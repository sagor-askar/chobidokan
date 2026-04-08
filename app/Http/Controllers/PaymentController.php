<?php

namespace App\Http\Controllers;

//use App\Mail\BookOrderEmail;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Project;
use App\Models\Subscription;
use App\Models\SubscriptionPurchase;
use App\Models\TempPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use ZipStream\ZipStream;



class PaymentController extends Controller
{
    public function projectOrder(Request $request)
    {
        DB::beginTransaction();
        try {
            $transaction_id = (string) Str::uuid();
            $subscription = Subscription::find($request->subscription_id);
            $data = $request->all();
            $data['user_id'] =  Auth::user()->id;
            $data['status'] =  1;
            $data['publish_date'] =Carbon::now()->format('Y-m-d');
            $data['expire_date'] = Carbon::now()->addDays($subscription->days)->format('Y-m-d');
            $project = Project::create($data);

            if ($request->hasFile('project_file')) {
                $file = $request->file('project_file');
                $fileName = time() . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
                $filePath = 'uploads/project/' . $fileName;
                $file->move(public_path('uploads/project'), $fileName);
                $project->project_file = $filePath;
            }
            $project->save();

            session(['project_id' => $project->id]);

            $store_id      = env('STORE_ID');
            $signature_key = env('SIGNATURE_KEY');
            $url           = env('AMARPAY_URL');

            $payload = [
                "store_id"      => $store_id,
                "tran_id"       => $transaction_id,
                "success_url"   => route('order.success'),
                "fail_url"      => route('order.fail'),
                "cancel_url"    => route('order.cancel'),
                "amount"        => $subscription->price,
                "currency"      => "BDT",
                "signature_key" => $signature_key,
                "desc"          => "Project Order Payment",
                "cus_name"      => $project->user->name,
                "cus_email"     => $project->user?->email ?? 'customer@example.com',
                "cus_add1"      => $project->user->address ?? 'Dhaka',
                "cus_phone"     => $project->user?->phone,
                "opt_a"         => $project->id,  // pass project_id for callback
                "opt_b"         => $subscription->id,  // pass project_id for callback
                "type"          => "json"
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            $response = curl_exec($ch);
            curl_close($ch);

            $responseObject = json_decode($response, true);

            if (isset($responseObject['payment_url']) && $responseObject['payment_url']) {
                DB::commit();
                return redirect()->away($responseObject['payment_url']);
            } else {
                DB::rollBack();
                return back()->with('error', 'Payment URL generation failed! Response: ' . $response);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function orderSuccess(Request $request)
    {
        $project_id = $request->opt_a;
        $subscription_id = $request->opt_b;
        $project = Project::find($project_id);
        $subscription = Subscription::find($subscription_id);
        if (!$project) {
            return redirect()->route('customize')->with('error', 'Your Order Failed !');
        }
        Auth::loginUsingId($project->user_id);
        $order =  Order::create([
            'project_id' => $project->id,
            'user_id' => $project->user_id,
            'subscription_id' => $subscription_id,
            'amount' =>$request->amount ?? $subscription->price,
            'card_type'      => $request->card_type ?? null,
            'bank_txn'       => $request->bank_txn ?? null,
        ]);

//        if ($order->email) {
//            $mail_data = [
//                'name' => $order->name,
//                'email' => $order->email,
//                'address' => $order->address,
//                'order_date' => Carbon::parse($order->created_at)->format('d-m-Y'),
//                'amount' => $order->total_amount,
//                'payment_type' =>$request->card_type,
//                'site_url' => "https://muktokowlom.com/",
//                'admin_email' => "support@muktokowlom.com",
//            ];
//            Mail::to($mail_data['email'])->send(new BookOrderEmail($mail_data));
//        }
        return redirect()->route('customize')->with('success', 'Your payment was successful!');
    }

    //  AmarPay Fail Callback
    public function orderFail(Request $request)
    {
        $projectId = $request->input('opt_a');
        $project = Project::find($projectId);
        Auth::loginUsingId($project->user_id);
        if ($project) {
            if ($project->project_file && file_exists(public_path($project->project_file))) {
                unlink(public_path($project->project_file));
            }
            $project->delete();
        }
        return redirect()->route('welcome')->with('error', 'Payment failed!');
    }

    // AmarPay Cancel Callback
    public function orderCancel(Request $request)
    {
        $projectId = session('project_id');
        $project = Project::find($projectId);
        Auth::loginUsingId($project->user_id);
        if ($project) {
            if ($project->project_file && file_exists(public_path($project->project_file))) {
                unlink(public_path($project->project_file));
            }
            $project->delete();
        }
        return redirect()->route('welcome')->with('error', 'Payment cancelled!');
    }

    //========== Product Purchase Payment=============//

    public function productPurchase(Request $request)
    {
        DB::beginTransaction();
        try {
            $transaction_id = (string) Str::uuid();
            $product = Product::find($request->product_id);
            $user = Auth::user();
            $amount = $request->price;
            $subscription_id = $request->subscription_id;

            session(['product_id' => $product->id]);

            $store_id      = env('STORE_ID');
            $signature_key = env('SIGNATURE_KEY');
            $url           = env('AMARPAY_URL');

            $payload = [
                "store_id"      => $store_id,
                "tran_id"       => $transaction_id,
                "success_url"   => route('purchase.success'),
                "fail_url"      => route('purchase.fail'),
                "cancel_url"    => route('purchase.cancel'),
                "amount"        => $amount,
                "currency"      => "BDT",
                "signature_key" => $signature_key,
                "desc"          => "Product Purchase Payment",
                "cus_name"      => $user->name,
                "cus_email"     => $user?->email ?? 'customer@example.com',
                "cus_add1"      => $user->address ?? 'Dhaka',
                "cus_phone"     => $user?->phone,
                "opt_a"         => $product->id,  // pass product_id for callback
                "opt_b"         => $user->id,  // pass user_id for callback
                "opt_c"         => $subscription_id,  // pass subscription_id for callback
                "type"          => "json"
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            $response = curl_exec($ch);
            curl_close($ch);

            $responseObject = json_decode($response, true);

            if (isset($responseObject['payment_url']) && $responseObject['payment_url']) {
                DB::commit();
                return redirect()->away($responseObject['payment_url']);
            } else {
                DB::rollBack();
                return back()->with('error', 'Payment URL generation failed! Response: ' . $response);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function purchaseSuccess(Request $request)
    {
        DB::beginTransaction();

        try {
            $product_id      = $request->opt_a;
            $user_id         = $request->opt_b;
            $subscription_id = $request->opt_c;

            $product = Product::findOrFail($product_id);
            if ($subscription_id == 0){
                $subscription_id = null;
                $payment = Payment::create([
                    'product_id'      => $product->id,
                    'subscription_id' => $subscription_id,
                    'designer_id'     => $product->designer_id,
                    'user_id'         => $user_id,
                    'amount'          => $request->amount,
                    'card_type'       => $request->card_type ?? null,
                    'bank_txn'        => $request->bank_txn ?? null,
                    'is_counted'      => 0,
                ]);
            }else{
                $payment = Payment::create([
                    'subscription_id' => $subscription_id,
                    'user_id'         => $user_id,
                    'amount'          => $request->amount,
                    'card_type'       => $request->card_type ?? null,
                    'bank_txn'        => $request->bank_txn ?? null,
                    'is_counted'      => 0,
                ]);
            }

            if ($subscription_id != null){
                $subscription = Subscription::where('id', $subscription_id)->first();

                SubscriptionPurchase::create([
                    'payment_id'      => $payment->id,
                    'subscription_id' => $subscription_id,
                    'user_id'         => $user_id,
                    'total_image'     => $subscription->total_image,
                    'total_purchase'  => 0,
                    'expire_date'     => Carbon::now()->addDays($subscription->days)->format('Y-m-d'),
                ]);
            }

            Auth::loginUsingId($user_id);

            DB::commit();

            // Pass download product_id to Blade
            return redirect()->route('welcome')
                ->with('download_product_id', base64_encode($product->id))
                ->with('success', 'Payment successful! Download started.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }




    //  AmarPay Fail Callback
    public function purchaseFail(Request $request)
    {
        $userId = $request->input('opt_b');
        Auth::loginUsingId($userId);
        return redirect()->route('welcome')->with('error', 'Payment failed!');
    }

    // AmarPay Cancel Callback
    public function purchaseCancel(Request $request)
    {
        $userId = $request->input('opt_b');
        Auth::loginUsingId($userId);
        return redirect()->route('welcome')->with('error', 'Payment cancelled!');
    }





    // cart payment integration for product
    public function cartCheckout()
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();
            $carts = Cart::with('product')
                ->where('user_id',$user->id)
                ->get();
            if($carts->isEmpty()){
                return back()->with('error','Cart is empty!');
            }
            $totalAmount = $carts->sum(fn($item)=>$item->product->price);
            $tran_id = (string) Str::uuid();

            TempPayment::create([
                'tran_id'      => $tran_id,
                'user_id'      => $user->id,
                'total_amount' => $totalAmount,
                'product_ids'  => json_encode($carts->pluck('product_id')->toArray()),
                'status'       => 'pending'
            ]);

            $payload = [
                "store_id"      => env('STORE_ID'),
                "tran_id"       => $tran_id,
                "success_url"   => route('cart.purchase.success'),
                "fail_url"      => route('purchase.fail'),
                "cancel_url"    => route('purchase.cancel'),
                "amount"        => $totalAmount,
                "currency"      => "BDT",
                "signature_key" => env('SIGNATURE_KEY'),
                "desc"          => "Cart Purchase",
                "cus_name"      => $user->name,
                "cus_email"     => $user->email,
                "cus_add1"      => $user->address ?? 'Dhaka',
                "cus_phone"     => $user->phone,
                "opt_b"         => $user->id,
                "type"          => "json"
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, env('AMARPAY_URL'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            $response = curl_exec($ch);
            curl_close($ch);

            $responseObject = json_decode($response, true);

            if(isset($responseObject['payment_url'])){
                DB::commit();
                return redirect()->away($responseObject['payment_url']);
            }

            DB::rollBack();
            return back()->with('error','Payment URL generation failed!');

        } catch(\Exception $e){

            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }
    }

    public function cartPurchaseSuccess(Request $request)
    {
        try {
            $user_id = $request->input('opt_b');
            Auth::loginUsingId($user_id);
            $tran_id = $request->mer_txnid;
            $tempPayment = TempPayment::where('tran_id', $tran_id)->firstOrFail();
            $cart_products = Cart::with('product')->where('user_id', $user_id)->get();

            if ($cart_products->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'No products in cart!');
            }

            $download_files = [];
            $product_ids = [];

            foreach ($cart_products as $cart_item) {
                $product = $cart_item->product;
                $product_ids[] = $product->id;
                if (!Payment::where('product_id', $product->id)->where('user_id', $user_id)->exists()) {
                    Payment::create([
                        'product_id'  => $product->id,
                        'designer_id' => $product->designer_id,
                        'user_id'     => $user_id,
                        'amount'      => $product->price,
                        'card_type'   => $request->card_type,
                        'bank_txn'    => $request->bank_txn,
                        'is_counted'  => 0,
                    ]);
                }

                $download_files[] = storage_path('app/' . $product->file_path);
            }

            Cart::where('user_id', $user_id)->delete();
//            TempPayment::where('tran_id', $tran_id)->delete();

            return view('frontend.menu.cart-payment-success', [
                'tran_id' => $tran_id,
                'download_files' => $download_files
            ]);

        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', 'Payment success but error: ' . $e->getMessage());
        }
    }

    public function cartPurchaseFail(Request $request)
    {
        $tran_id = $request->mer_txnid ?? null;

        if($tran_id){
            TempPayment::where('tran_id',$tran_id)->delete();
        }

        $userId = $request->input('opt_b');
        Auth::loginUsingId($userId);
        return redirect()->route('welcome')->with('error','Payment failed!');
    }

    public function cartPurchaseCancel(Request $request)
    {
        $tran_id = $request->mer_txnid ?? null;

        if($tran_id){
            TempPayment::where('tran_id',$tran_id)->delete();
        }

        $userId = $request->input('opt_b');
        Auth::loginUsingId($userId);

        return redirect()->route('welcome')->with('error','Payment cancelled!');
    }


    //========== Subscription Purchase Payment=============//

    public function subscriptionPurchase(Request $request)
    {
        DB::beginTransaction();
        try {
            $transaction_id = (string) Str::uuid();
            $user = Auth::user();
            $subscription_id = $request->subscription_id;
            $subscription = Subscription::findOrFail($subscription_id);
            $amount = $subscription->price;

            session(['subscription_id' => $subscription_id]);

            $store_id      = env('STORE_ID');
            $signature_key = env('SIGNATURE_KEY');
            $url           = env('AMARPAY_URL');

            $payload = [
                "store_id"      => $store_id,
                "tran_id"       => $transaction_id,
                "success_url"   => route('subscription.success'),
                "fail_url"      => route('subscription.fail'),
                "cancel_url"    => route('subscription.cancel'),
                "amount"        => $amount,
                "currency"      => "BDT",
                "signature_key" => $signature_key,
                "desc"          => "Subscription Purchase Payment",
                "cus_name"      => $user->name,
                "cus_email"     => $user?->email ?? 'customer@example.com',
                "cus_add1"      => $user->address ?? 'Dhaka',
                "cus_phone"     => $user?->phone,
                "opt_a"         => $subscription->id,  // pass subscription id for callback
                "opt_b"         => $user->id,  // pass user_id for callback
                "type"          => "json"
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            $response = curl_exec($ch);
            curl_close($ch);

            $responseObject = json_decode($response, true);

            if (isset($responseObject['payment_url']) && $responseObject['payment_url']) {
                DB::commit();
                return redirect()->away($responseObject['payment_url']);
            } else {
                DB::rollBack();
                return back()->with('error', 'Payment URL generation failed! Response: ' . $response);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
    public function subscriptionSuccess(Request $request)
    {
        DB::beginTransaction();

        try {
            $subscription_id      = $request->opt_a;
            $user_id         = $request->opt_b;

            $subscription = Subscription::findOrFail($subscription_id);
            $payment = Payment::create([
                'subscription_id' => $subscription_id,
                'user_id'         => $user_id,
                'amount'          => $request->amount,
                'card_type'       => $request->card_type ?? null,
                'bank_txn'        => $request->bank_txn ?? null,
                'is_counted'      => 0,
            ]);

                SubscriptionPurchase::create([
                    'payment_id'      => $payment->id,
                    'subscription_id' => $subscription_id,
                    'user_id'         => $user_id,
                    'total_image'     => $subscription->total_image,
                    'total_purchase'  => 0,
                    'expire_date'     => Carbon::now()->addDays($subscription->days)->format('Y-m-d'),
                ]);
            Auth::loginUsingId($user_id);
            DB::commit();
            // Pass download product_id to Blade
            return redirect()->route('welcome')->with('success', 'Payment Successfully Done .');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function subscriptionFail(Request $request)
    {
        $userId = $request->input('opt_b');
        Auth::loginUsingId($userId);
        return redirect()->route('welcome')->with('error', 'Payment failed!');
    }

    public function subscriptionCancel(Request $request)
    {
        $userId = $request->input('opt_b');
        Auth::loginUsingId($userId);
        return redirect()->route('welcome')->with('error', 'Payment cancelled!');
    }
}
