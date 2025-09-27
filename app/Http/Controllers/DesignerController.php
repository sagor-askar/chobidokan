<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Project;
use App\Models\ProjectSubmit;
use App\Models\Upload;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class DesignerController extends Controller
{


    public function dashboard()
    {
        $user = Auth::user();
        return view('frontend.seller.dashboard',compact('user'));
    }

    public function about($id)
    {
        $user = User::findOrFail($id);
        return view('frontend.seller.about', compact('user'));
    }

//    public function submittedWorks($id)
//    {
//        $user = User::findOrFail($id);
//        $uploads = Upload::with(['projectSubmit', 'project'])
//            ->whereHas('projectSubmit', fn($q) => $q->where('user_id', $id))
//            ->paginate(6);
//        return view('frontend.profiles.tabs.submittedWorks', compact('user', 'uploads'));
//    }


    public function orders()
    {
        $orderProjects = Project::with(['projectSubmits', 'uploads'])
            ->where('status', 1)
            ->whereHas('projectSubmits', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->whereHas('uploads', function ($upload) {
                $upload->where('status', 1)
                    ->whereColumn('uploads.project_id', 'projects.id')
                    ->whereIn('uploads.project_submit_id', function ($sub) {
                        $sub->select('id')
                            ->from('project_submits')
                            ->whereColumn('project_submits.project_id', 'projects.id')
                            ->where('project_submits.user_id', Auth::id());
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('frontend.seller.orders', compact('orderProjects'));
    }

    public function orderDelivery($id)
    {
       $selectedImages = Upload::with('project')
                           ->whereHas('projectSubmits', function ($q) {
                               $q->where('user_id', Auth::id());
                           })
                           ->where('project_id', $id)->where('status',1)->get();

        return view('frontend.seller.order-delivery',compact('selectedImages'));
    }

    public function orderHistory()
    {
        $orderHistories = Project::with('projectSubmits')
            ->where('status', 2)
            ->whereHas('projectSubmits', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('frontend.seller.order-history',compact('orderHistories'));
    }

    public function orderSubmit(Request $request, $id)
    {
        $request->validate(
            [
                'design_file.*' => 'required|mimes:jpg,jpeg,png,gif,zip',
            ],
            [
                'design_file.*.mimes' => 'Only JPG, JPEG, PNG, GIF, ZIP formats are allowed.',
            ]
        );

        try {
            DB::beginTransaction();

            $order = Order::where('project_id', $id)->first();

            if ($request->hasFile('design_file')) {
                foreach ($request->file('design_file') as $file) {

                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $cleanName = preg_replace('/\s+/', '_', $originalName);
                    $filename = $cleanName . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    $destinationPath = public_path('uploads/project/approved-file/' . $filename);

                    if ($file->getClientOriginalExtension() !== 'zip') {
                        // Image resize
                        $img = Image::make($file->getRealPath());
                        $img->resize(1200, null, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })->save($destinationPath, 90);
                    } else {
                        // ZIP save as-is
                        $file->move(public_path('uploads/project/approved-file/'), $filename);
                    }

                    $type = $file->getClientMimeType();
                    if ($type === 'application/x-zip-compressed') {
                        $type = 'application/zip';
                    }

                    // Save in database
                    OrderDetails::create([
                        'project_id' => $id,
                        'order_id' => $order->id,
                        'user_id' => Auth::id(),
                        'file_path' => 'uploads/project/approved-file/' . $filename,
                        'file_name' => $filename,
                        'file_type' => $type,
                    ]);
                }
            }

            DB::commit();
            return back()->with('success', 'Order Submitted Successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Order Submission failed: ' . $e->getMessage());
        }
    }

    public function rejectedOrders()
    {

        return ' Incomplete' ;

//        $orderProjects = Project::with(['orderDetails'])
//            ->where('status', 1)
//            ->whereHas('orderDetails', function ($q) {
//                $q->where('user_id', Auth::id());
//            })
//            ->orderBy('created_at', 'desc')
//            ->get();
//
//        foreach ($orderProjects as $orderProject) {
//
//            $rejectedOrders = Comment::where('project_id', $orderProject->id)->get();
//        }
//
//        return view('frontend.seller.order-history',compact('orderHistories'));
    }


    public function manageProfile($id)
    {
        $user = User::findOrFail($id);
        return view('frontend.seller.manageProfile', compact('user'));
    }

    public function changePassword($id)
    {
        $user = User::findOrFail($id);
        return view('frontend.seller.changePassword', compact('user'));
    }

}
