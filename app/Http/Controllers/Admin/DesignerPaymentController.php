<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DesignerPaymentController extends Controller
{
    public function designerPayment(Request $request)
    {

        try {
            $transaction_id = (string) Str::uuid();
            $projectId = $request->input('project_id');
            $designerId = $request->input('designer_id');

            $project = Project::with('order')->whereHas('order', function ($query) use ($projectId) {
                $query->where('project_id', $projectId)
                    ->where('status', 0);
            })
                ->where('status', 2)->first();

            $user = User::find($designerId);


            $designerPercentage = 80;
            $orderAmount = $project->order->amount;
            $designerAmount = ($designerPercentage / 100) * $orderAmount;



            $store_id      = env('STORE_ID');
            $signature_key = env('SIGNATURE_KEY');
            $url           = env('AMARPAY_URL');

            $payload = [
                "store_id"      => $store_id,
                "tran_id"       => $transaction_id,
                "success_url"   => route('designer.payment.success'),
                "fail_url"      => route('designer.payment.fail'),
                "cancel_url"    => route('designer.payment.cancel'),
                "amount"        => $designerAmount,
                "currency"      => "BDT",
                "signature_key" => $signature_key,
                "desc"          => "designer Payment",
                "cus_name"      => $user->name,
                "cus_email"     => $user->email ?? 'customer@example.com',
                "cus_add1"      => $user->address ?? 'Dhaka',
                "cus_add2" => "Mohakhali DOHS",
                "cus_city"=> "Dhaka",
                "cus_state"=> "Dhaka",
                "cus_postcode"=> "1206",
                "cus_country"=> "Bangladesh",
                "cus_phone"  => $user->phone,
                "opt_a"         => $project->id,  // pass project_id
                "opt_b"         => $project->order->id,  // pass  order_id
                "opt_c"         => $user->id,  // pass  designer_id
                "opt_d"         => Auth::user()->id,  // pass admin id
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

                return redirect()->away($responseObject['payment_url']);
            } else {

                return back()->with('error', 'Payment URL generation failed! Response: ' . $response);
            }

        } catch (\Exception $e) {

            return back()->with('error', 'Error: ' . $e->getMessage());
        }


    }

    public function designerPaymentSuccess(Request $request)
    {
        $project_id = $request->opt_a;
        $order_id = $request->opt_b;
        $designer_id = $request->opt_c;
        $admin_id = $request->opt_d;

        $order = Order::find($order_id);
        $payment =  Payment::create([
            'order_id' => $order->id,
            'project_id' => $project_id,
            'user_id' => $designer_id,
            'amount' =>$request->amount,
            'card_type'      => $request->card_type ?? null,
            'bank_txn'       => $request->bank_txn ?? null,
        ]);

        $order->status = 1;
        $order->save();


        Auth::loginUsingId($admin_id);

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

        return redirect()->route('admin.project.list')->with('success', 'Designer payment was successful!');
    }

    //  AmarPay Fail Callback
    public function designerPaymentFail(Request $request)
    {
        $admin_id = $request->opt_d;
        Auth::loginUsingId($admin_id);
        return redirect()->route('admin.project.list')->with('error', 'Payment failed!');

    }

    // AmarPay Cancel Callback
    public function designerPaymentCancel(Request $request)
    {
        $admin_id = $request->opt_d;
        Auth::loginUsingId($admin_id);
        return redirect()->route('admin.project.list')->with('error', 'Payment cancelled!');
    }
}
