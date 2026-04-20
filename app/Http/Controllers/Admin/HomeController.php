<?php

namespace App\Http\Controllers\Admin;

use App\Models\DesignerPayment;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\RefundPayment;
use App\Models\SubscriptionDownloadProduct;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Project;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController
{
    public function index()
    {
        $totalActiveProduct  = Product::where('status',1)->count();
        $totalInctiveProduct  = Product::where('status',0)->count();

        $totalDesigner  = User::where('role_id',2)->count();
        $totalCustomer  = User::where('role_id',3)->count();


        $totalCompletedProject  = Project::where('status',2)->count();
        $totalActiveProject  = Project::where('status',1)->count();
        $totalRejectedProject  = Project::where('status',0)->count();


        $totalProductSales       = Payment::where('order_id', null)->where('project_id', null)->get();
        $totalProductSalesAmount =$totalProductSales->sum('amount');

        $totalProjectOrder = Order::all();
        $totalProjectOrderAmount =$totalProjectOrder->sum('amount');

        $totalAmount = $totalProductSalesAmount + $totalProjectOrderAmount;


        $totalProductPayments  = DesignerPayment::where('product_id','!=',null)->sum('amount');
        $totalProjectPayments  = DesignerPayment::where('project_id','!=',null)->sum('amount');
        $totalPaidAmount = $totalProductPayments + $totalProjectPayments;


        $totalProductSale  = DesignerPayment::where('product_id','!=',null)->count();
        $totalProjectSale  = DesignerPayment::where('project_id','!=',null)->count();


        $orderDuePayment = 0;
        $adminPercentage = Setting::first()->admin_percentage;
        $orderDetails =OrderDetails::with('order','project','designer')
            ->whereHas('order', function ($query){
                $query->where('status', 0);
            })
            ->whereHas('project', function ($query){
                $query->where('status', 2);
            })
           ->get();

        foreach ($orderDetails->unique('order_id') as $orderDetail) {
            $orderDuePayment += $orderDetail->order->amount - ($orderDetail->order->amount * ($adminPercentage / 100));
        }

        $productDueamount = 0;
        // 1. Direct Product Sales
        $directSales = Payment::with(['product'])
            ->whereNull('order_id')
            ->whereNull('project_id')
            ->whereNull('subscription_id')
            ->where('designer_paid_status', 0)
            ->has('product') // Ensure product exists
            ->get();

        // 2. Subscription Product Downloads
        $downloadHistories = SubscriptionDownloadProduct::with(['product'])
            ->has('product')
            ->where('designer_paid_status', 0)
            ->get();

        foreach ($directSales as $sale) {
            $productPrice = $sale->product->price ?? 0;
            $productDueamount += $productPrice - ($productPrice * ($adminPercentage / 100));
        }

        foreach ($downloadHistories as $download) {
            $productPrice = $download->product->price ?? 0;
            $productDueamount += $productPrice - ($productPrice * ($adminPercentage / 100));
        }

        // Total Due for both Projects and Products
        $totalDuePayment = $orderDuePayment + $productDueamount;

        $refundPayments = RefundPayment::all();
        $refundPaymentsAmount =$refundPayments->sum('amount');


        $totalEarningAmount = $totalAmount - $totalDuePayment - $refundPaymentsAmount;



        return view('home', compact(
            'totalActiveProduct', 'totalInctiveProduct', 'totalDesigner', 'totalCustomer',
            'totalCompletedProject', 'totalActiveProject', 'totalRejectedProject',
            'orderDuePayment', 'productDueamount', 'totalDuePayment','totalProductSales','totalProductSalesAmount','totalProjectOrderAmount','totalAmount'
            ,'totalPaidAmount','refundPaymentsAmount','totalProductSale','totalProjectSale','totalEarningAmount'
        ));
    }
}
