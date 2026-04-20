<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\DesignerPayment;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Payment;
use App\Models\Project;
use App\Models\ProjectSubmit;
use App\Models\RefundPayment;
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\SubscriptionDownloadProduct;
use App\Models\SubscriptionPurchase;
use App\Models\Upload;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function projectList()
    {
        $projectsQuery = Project::with(['user', 'order', 'subscription'])
            ->withCount([
                'projectSubmit as total_designer' => function ($query) {
                    $query->select(\DB::raw('COUNT(DISTINCT designer_id)'));
                },
                'uploads as total_submitted_design'
            ])
            ->where('status', 1)
            ->orderBy('id', 'desc');
        $projects = $projectsQuery->paginate(10);
        return view('admin.project.project-list', compact('projects'));
    }

    public function activeProjectDetails($id)
    {
        $designers = ProjectSubmit::where('project_id', $id)
            ->with(['designer', 'uploads'])
            ->get()
            ->unique('designer_id')
            ->values();
        return view('admin.project.active-project-details', compact('designers'));
    }


    public function completedProjectList()
    {
        $projectsQuery = Project::with(['user', 'order', 'subscription'])
            ->withCount([
                'projectSubmit as total_designer' => function ($query) {
                    $query->select(\DB::raw('COUNT(DISTINCT designer_id)'));
                },
                'uploads as total_submitted_design'
            ])
            ->where('status', 2)
            ->orderBy('id', 'desc');
        $projects = $projectsQuery->paginate(10);
        return view('admin.project.completed-project-list', compact('projects'));
    }


    public function rejectedProjectList()
    {
        $projectsQuery = Project::with(['user', 'order', 'subscription'])
            ->withCount([
                'projectSubmit as total_designer' => function ($query) {
                    $query->select(\DB::raw('COUNT(DISTINCT designer_id)'));
                },
                'uploads as total_submitted_design'
            ])
            ->where('status', 0)
            ->orderBy('id', 'desc');
        $projects = $projectsQuery->paginate(10);
        return view('admin.project.rejected-project-list', compact('projects'));
    }


    public function rejectedProjectDetails($id)
    {
        $designers = ProjectSubmit::where('project_id', $id)
            ->with(['designer', 'uploads'])
            ->get()
            ->unique('designer_id')
            ->values();
        return view('admin.project.rejected-project-details', compact('designers'));
    }

    public function completedProjectDetails($id)
    {
        $designers = ProjectSubmit::where('project_id', $id)
            ->with(['designer', 'uploads'])
            ->get()
            ->unique('designer_id')
            ->values();
        return view('admin.project.completed-project-details', compact('designers'));
    }

    public function designerSubmitDetails($projectId, $designerId)
    {

        $designerSubmitfiles = Upload::with(['project','projectSubmit'])->whereHas('projectSubmit', function ($query) use ($projectId, $designerId) {
                                $query->where('project_id', $projectId)
                                      ->where('designer_id', $designerId);
                                       })
                                ->get();
        return view('admin.project.submit-design-show', compact('designerSubmitfiles'));

    }



    public function paymentProjectList()
    {
        $adminPercentage = Setting::first()->admin_percentage;
        $orderDetailsQuery =OrderDetails::with('order','project','designer')
                                  ->whereHas('order', function ($query){
                                       $query->where('status', 0);
                                    })
                                  ->whereHas('project', function ($query){
                                        $query->where('status', 2);
                                   })
                                 ->orderBy('id', 'desc');
              $orderDetails = $orderDetailsQuery->paginate(10);

        return view('admin.payment.payment-project-list', compact('orderDetails','adminPercentage'));
    }



    public function paymentRefundList()
    {
        $adminPercentage = Setting::first()->admin_percentage;
        $orderRejectQuery =Payment::with('order','project','user')
            ->whereHas('order', function ($query){
                $query->where('status', 2);
            })
            ->whereHas('project', function ($query){
                $query->where('status', 0);
            })
            ->where('designer_paid_status', 0)
            ->orderBy('id', 'desc');
        $paymentRefundOrders = $orderRejectQuery->paginate(10);
        return view('admin.payment.payment-refund-list', compact('paymentRefundOrders','adminPercentage'));
    }



    public function paymentProductList()
    {
        $adminPercentage = Setting::first()->admin_percentage;

        // 1. Direct Product Sales
        $directSales = Payment::with(['product', 'product.category', 'product.designer', 'user'])
            ->whereNull('order_id')
            ->whereNull('project_id')
            ->whereNull('subscription_id')
            ->where('designer_paid_status', 0)
            ->get();

        // 2. Subscription Product Downloads
        $downloadHistories = SubscriptionDownloadProduct::with(['product', 'product.category', 'product.designer'])
            ->has('product')
            ->where('designer_paid_status', 0)
            ->get();

        // Fetch user data for subscription downloads efficiently
        $subPurchaseIds = $downloadHistories->pluck('subscription_purchase_id')->unique();
        $subPurchases = SubscriptionPurchase::with('user')->whereIn('id', $subPurchaseIds)->get()->keyBy('id');

        $paymentIds = $subPurchases->pluck('payment_id')->filter()->unique();
        $payments = Payment::whereIn('id', $paymentIds)->get()->keyBy('id');

        $combinedSales = collect();

        foreach ($directSales as $sale) {
            // Earning amount = Sale Amount - (Sale Amount * Admin Percentage / 100)
            $earning_amount = $sale->product->price - ($sale->product->price * ($adminPercentage / 100));

            $combinedSales->push((object)[
                'id' => $sale->id,
                'payment_id' => $sale->id,
                'type' => 'direct',
                'product' => $sale->product,
                'designer' => $sale->product ? $sale->product->designer : null,
                'user' => $sale->user,
                'amount' => $sale->amount,
                'earning_amount' => $earning_amount,
                'card_type' => $sale->card_type,
                'subscription_id' => $sale->subscription_id,
                'designer_paid_status' => $sale->designer_paid_status,
                'created_at' =>  Carbon::parse($sale->created_at)->format('Y-m-d'),
            ]);
        }

        foreach ($downloadHistories as $download) {
            $subPurchase = $subPurchases->get($download->subscription_purchase_id);
            $payment = $subPurchase ? $payments->get($subPurchase->payment_id) : null;
            $cardType = $payment ? $payment->card_type : 'N/A';

            $productPrice = $download->product->price ?? 0;
            $earning_amount = $productPrice - ($productPrice * ($adminPercentage / 100));

            $combinedSales->push((object)[
                'id' => $download->id,
                'payment_id' => $payment ? $payment->id : null,
                'type' => 'subscription',
                'product' => $download->product,
                'designer' => $download->product ? $download->product->designer : null,
                'user' => $subPurchase ? $subPurchase->user : null,
                'amount' => $productPrice,
                'earning_amount' => $earning_amount,
                'card_type' => $cardType,
                'subscription_id' => null,
                'designer_paid_status' => $download->designer_paid_status,
                'created_at' =>  Carbon::parse($download->created_at)->format('Y-m-d'),
            ]);
        }

        // Sort descending by creation date
        $combinedSales = $combinedSales->sortByDesc('created_at');

        // Handle Pagination for combined arrays
        $page = request()->get('page', 1);
        $perPage = 10;

        $productSaleslist = new \Illuminate\Pagination\LengthAwarePaginator(
            $combinedSales->forPage($page, $perPage)->values(),
            $combinedSales->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('admin.payment.payment-product-list', compact('productSaleslist'));
    }


    public function designerPaymentHistory()
    {
        $designerPaymentQuery    =DesignerPayment::with('payment','project','product','designer','user')
                                   ->orderBy('id', 'desc');
        $designerPaymentHistories = $designerPaymentQuery->paginate(10);

        return view('admin.payment.payment-history', compact('designerPaymentHistories'));
    }

    public function refundPaymentHistory()
    {
        $refundPaymentQuery =RefundPayment::with('payment','project','order','user')
            ->orderBy('id', 'desc');
        $refundPaymentHistories = $refundPaymentQuery->paginate(10);

        return view('admin.payment.refund-payment-history', compact('refundPaymentHistories'));
    }


    public function projectDelete($id)
    {
        $project = Project::find($id);
        if ($project->project_file && file_exists(public_path($project->project_file))) {
            unlink(public_path($project->project_file));
        }
        $project->delete();
        return redirect()->route('admin.project.list')->with('success', 'Project deleted successfully.');
    }

}
