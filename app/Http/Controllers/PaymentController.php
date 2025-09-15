<?php

namespace App\Http\Controllers;

//use App\Mail\BookOrderEmail;

use App\Models\Order;
use App\Models\Project;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

//            $store_id      = env('STORE_ID');
//            $signature_key = env('SIGNATURE_KEY');
//            $url           = env('AMARPAY_URL');

            $store_id      = "aamarpaytest";
            $signature_key = "dbb74894e82415a2f7ff0ec3a97e4183";
            $url           = "https://sandbox.aamarpay.com/jsonpost.php";

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
}
