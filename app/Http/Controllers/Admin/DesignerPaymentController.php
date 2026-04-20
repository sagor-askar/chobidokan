<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DesignerPayment;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Project;
use App\Models\RefundPayment;
use App\Models\Subscription;
use App\Models\SubscriptionDownloadProduct;
use App\Models\SubscriptionPurchase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DesignerPaymentController extends Controller
{
    public function designerProductPayment(Request $request)
    {
        DB::beginTransaction();
        try {
            $transaction_id = (string) Str::uuid();

            $productId = $request->input('product_id');
            $paymentId = $request->input('payment_id');
            $designerId = $request->input('designer_id');
            $userId = $request->input('user_id');
            $amount = $request->input('amount');

            $designer = User::find($designerId);

            $store_id      = env('STORE_ID');
            $signature_key = env('SIGNATURE_KEY');
            $url           = env('AMARPAY_URL');

            $payload = [
                "store_id"      => $store_id,
                "tran_id"       => $transaction_id,
                "success_url"   => route('designer.product.payment.success'),
                "fail_url"      => route('designer.product.payment.fail'),
                "cancel_url"    => route('designer.product.payment.cancel'),
                "amount"        => $amount,
                "currency"      => "BDT",
                "signature_key" => $signature_key,
                "desc"          => "Designer product Payment",
                "cus_name"      => $designer->name,
                "cus_email"     => $designer->email ?? 'customer@example.com',
                "cus_add1"      => $designer->address ?? 'Dhaka',
                "cus_add2" => "Mohakhali DOHS",
                "cus_city"=> "Dhaka",
                "cus_state"=> "Dhaka",
                "cus_postcode"=> "1206",
                "cus_country"=> "Bangladesh",
                "cus_phone"  => $designer->phone,
                "opt_a"         => $productId,  // pass product_id
                "opt_b"         => $paymentId,  // pass  payment_id
                "opt_c"         => $designer->id,  // pass  designer_id
                "opt_d"         => $userId . '|' . Auth::id(),  // pass user id and admin id
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

    public function designerProductPaymentSuccess(Request $request)
    {
        DB::beginTransaction();
        try {
            $productId = $request->opt_a;
            $paymentId = $request->opt_b;
            $designerId = $request->opt_c;

            $opt_d_parts = explode('|', $request->opt_d);
            $userId = $opt_d_parts[0] ?? null;
            $adminId = $opt_d_parts[1] ?? null;


              $payment = Payment::findOrFail($paymentId);
              if ($payment->subscription_id){
                  $subscriptionPurchase = SubscriptionPurchase::where('payment_id', $paymentId)->first();
                  $subscriptionPurchaseProduct = SubscriptionDownloadProduct::where('subscription_purchase_id', $subscriptionPurchase->id)->where('product_id',$productId)->first();
                 if ($subscriptionPurchaseProduct->designer_paid_status == 0){

                     DesignerPayment::create([
                         'product_id' => $productId,
                         'payment_id' => $paymentId,
                         'designer_id' => $designerId,
                         'user_id' => $userId,
                         'amount' =>$request->amount,
                         'card_type'      => $request->card_type ?? null,
                         'bank_txn'       => $request->bank_txn ?? null,
                     ]);

                     $subscriptionPurchaseProduct->designer_paid_status = 1;
                     $subscriptionPurchaseProduct->save();
                 }
                  $subscriptionPurchaseProducts = SubscriptionDownloadProduct::where('subscription_purchase_id', $subscriptionPurchase->id)->where('designer_paid_status',0)->get();
                if (!$subscriptionPurchaseProducts->count() > 0){
                    $payment->designer_paid_status = 1;
                    $payment->save();
                }
              }else{
                   if($payment->designer_paid_status == 0){
                       DesignerPayment::create([
                           'product_id' => $productId,
                           'payment_id' => $paymentId,
                           'designer_id' => $designerId,
                           'user_id' => $userId,
                           'amount' =>$request->amount,
                           'card_type'      => $request->card_type ?? null,
                           'bank_txn'       => $request->bank_txn ?? null,
                       ]);

                       $payment->designer_paid_status = 1;
                       $payment->save();
                   }
              }
            if ($adminId) {
                Auth::loginUsingId($adminId);
            }

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

            DB::commit();
            return redirect()->route('admin.payment-product.list')->with('success', 'Designer Payment is successfully Done!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.payment-product.list')->with('error', 'Error: ' . $e->getMessage());
        }
    }

    //  AmarPay Fail Callback
    public function designerProductPaymentFail(Request $request)
    {
        $opt_d_parts = explode('|', $request->opt_d);
        $adminId = $opt_d_parts[1] ?? null;
        if ($adminId) {
            Auth::loginUsingId($adminId);
        }
        return redirect()->route('admin.payment-product.list')->with('error', 'Payment failed!');

    }

    // AmarPay Cancel Callback
    public function designerProductPaymentCancel(Request $request)
    {
        $opt_d_parts = explode('|', $request->opt_d);
        $adminId = $opt_d_parts[1] ?? null;
        if ($adminId) {
            Auth::loginUsingId($adminId);
        }
        return redirect()->route('admin.payment-product.list')->with('error', 'Payment cancelled!');
    }





    //========== Designer  Project Payment=============//


    public function designerProjectPayment(Request $request)
    {
        DB::beginTransaction();
        try {
            $transaction_id = (string) Str::uuid();

            $projectId = $request->input('project_id');
            $orderId = $request->input('order_id');
            $designerId = $request->input('designer_id');
            $userId = $request->input('user_id');
            $amount = $request->input('amount');

            $designer = User::find($designerId);

            $store_id      = env('STORE_ID');
            $signature_key = env('SIGNATURE_KEY');
            $url           = env('AMARPAY_URL');

            $payload = [
                "store_id"      => $store_id,
                "tran_id"       => $transaction_id,
                "success_url"   => route('designer.project.payment.success'),
                "fail_url"      => route('designer.project.payment.fail'),
                "cancel_url"    => route('designer.project.payment.cancel'),
                "amount"        => $amount,
                "currency"      => "BDT",
                "signature_key" => $signature_key,
                "desc"          => "Designer Project Payment",
                "cus_name"      => $designer->name,
                "cus_email"     => $designer->email ?? 'customer@example.com',
                "cus_add1"      => $designer->address ?? 'Dhaka',
                "cus_add2" => "Mohakhali DOHS",
                "cus_city"=> "Dhaka",
                "cus_state"=> "Dhaka",
                "cus_postcode"=> "1206",
                "cus_country"=> "Bangladesh",
                "cus_phone"  => $designer->phone,
                "opt_a"         => $projectId,  // pass project_id
                "opt_b"         => $orderId,  // pass  order_id
                "opt_c"         => $designer->id,  // pass  designer_id
                "opt_d"         => Auth::id(),  // pass user id and admin id
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

    public function designerProjectPaymentSuccess(Request $request)
    {
        DB::beginTransaction();
        try {
            $projectId = $request->opt_a;
            $orderId = $request->opt_b;
            $designerId = $request->opt_c;
            $adminId = $request->opt_d;

           $order = Order::where('id', $orderId)->where('status',0)->first();
           if ($order) {
             $payment = Payment::create([
                   'order_id' => $orderId,
                   'project_id' => $order->project_id,
                   'user_id' => $order->user_id,
                   'amount' =>  $order->amount,
                   'card_type'=>$order->card_type ?? null,
                   'bank_txn' => $order->bank_txn ?? null,
                   'designer_paid_status' => 1,
               ]);

               DesignerPayment::create([
                   'project_id' => $projectId,
                   'payment_id' => $payment->id,
                   'designer_id' => $designerId,
                   'user_id' => $order->user_id,
                   'amount' =>$request->amount,
                   'card_type'      => $request->card_type ?? null,
                   'bank_txn'       => $request->bank_txn ?? null,
               ]);

               $order->status = 1;
               $order->save();
           }

            if ($adminId) {
                Auth::loginUsingId($adminId);
            }

            DB::commit();
            return redirect()->route('admin.payment-project.list')->with('success', 'Designer Payment is successfully Done!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.payment-project.list')->with('error', 'Error: ' . $e->getMessage());
        }
    }

    //  AmarPay Fail Callback
    public function designerProjectPaymentFail(Request $request)
    {
        $adminId = $request->opt_d;
        if ($adminId) {
            Auth::loginUsingId($adminId);
        }
        return redirect()->route('admin.payment-project.list')->with('error', 'Payment failed!');

    }

    // AmarPay Cancel Callback
    public function designerProjectPaymentCancel(Request $request)
    {
        $adminId = $request->opt_d;
        if ($adminId) {
            Auth::loginUsingId($adminId);
        }
        return redirect()->route('admin.payment-project.list')->with('error', 'Payment cancelled!');
    }



    //========== Refund Project Payment=============//


    public function refundProjectPayment(Request $request)
    {
        DB::beginTransaction();
        try {
            $transaction_id = (string) Str::uuid();


            $amount = $request->input('amount');
            $paymentId = $request->input('payment_id');

            $payment = Payment::find($paymentId);
            $user = User::find($payment->user_id);

            $store_id      = env('STORE_ID');
            $signature_key = env('SIGNATURE_KEY');
            $url           = env('AMARPAY_URL');

            $payload = [
                "store_id"      => $store_id,
                "tran_id"       => $transaction_id,
                "success_url"   => route('refund.project.payment.success'),
                "fail_url"      => route('refund.project.payment.fail'),
                "cancel_url"    => route('refund.project.payment.cancel'),
                "amount"        => $amount,
                "currency"      => "BDT",
                "signature_key" => $signature_key,
                "desc"          => "Refund Project Payment",
                "cus_name"      => $user->name,
                "cus_email"     => $user->email ?? 'customer@example.com',
                "cus_add1"      => $user->address ?? 'Dhaka',
                "cus_add2" => "Mohakhali DOHS",
                "cus_city"=> "Dhaka",
                "cus_state"=> "Dhaka",
                "cus_postcode"=> "1206",
                "cus_country"=> "Bangladesh",
                "cus_phone"  => $user->phone,
                "opt_a"         => $payment->id,  // pass payment_id
                "opt_b"         => Auth::id(),  // pass  AdminId
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

    public function refundProjectPaymentSuccess(Request $request)
    {
        DB::beginTransaction();
        try {
            $paymentId = $request->opt_a;
            $adminId = $request->opt_b;

            $payment = Payment::where('id', $paymentId)->where('designer_paid_status',0)->first();
            if ($payment) {
                RefundPayment::create([
                    'project_id' => $payment->project_id,
                    'payment_id' => $payment->id,
                    'order_id' => $payment->order_id,
                    'user_id' => $payment->user_id,
                    'amount' =>$request->amount,
                    'card_type'      => $request->card_type ?? null,
                    'bank_txn'       => $request->bank_txn ?? null,
                ]);

                $payment->designer_paid_status = 1;
                $payment->save();
            }

            if ($adminId) {
                Auth::loginUsingId($adminId);
            }

            DB::commit();
            return redirect()->route('admin.payment-refund.list')->with('success', 'Designer Payment is successfully Done!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.payment-refund.list')->with('error', 'Error: ' . $e->getMessage());
        }
    }

    //  AmarPay Fail Callback
    public function refundProjectPaymentFail(Request $request)
    {
        $adminId = $request->opt_b;
        if ($adminId) {
            Auth::loginUsingId($adminId);
        }
        return redirect()->route('admin.payment-refund.list')->with('error', 'Payment failed!');

    }

    // AmarPay Cancel Callback
    public function refundProjectPaymentCancel(Request $request)
    {
        $adminId = $request->opt_b;
        if ($adminId) {
            Auth::loginUsingId($adminId);
        }
        return redirect()->route('admin.payment-refund.list')->with('error', 'Payment cancelled!');
    }
}
