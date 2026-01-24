<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Project;
use App\Models\ProjectSubmit;
use App\Models\Upload;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class DesignerController extends Controller
{


    public function dashboard()
    {
        $user = Auth::user();
        return view('frontend.seller.dashboard',compact('user'));
    }

    public function about()
    {
        $user = User::findOrFail(Auth::id());
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
        $orderHistories = Project::with('projectSubmits','orderDetails')
            ->where('status', 2)
            ->whereHas('projectSubmits', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->whereHas('orderDetails', function ($d) {
                $d->where('user_id', Auth::id());
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('frontend.seller.order-history',compact('orderHistories'));
    }

    public function submittedOrderFile($id)
    {
        $orderSubmittedFiles = OrderDetails::with(['project','user'])
            ->where('project_id', $id)
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('frontend.seller.order-submitted', compact('orderSubmittedFiles'));
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
        $rejectedOrders = Project::with(['projectSubmits', 'uploads'])
            ->where('status', 0)
            ->whereHas('projectSubmits', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->whereHas('uploads', function ($upload) {
                $upload->where('status', 0)
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

        return view('frontend.seller.order-rejected', compact('rejectedOrders'));
    }

    public function rejectedOrderFile($id)
    {
        $orderRejectedFiles = Upload::with(['projectSubmits'])
            ->where('project_id', $id)
            ->whereHas('projectSubmits', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('frontend.seller.order-rejected-file', compact('orderRejectedFiles'));
    }



    public function productList()
    {

        $products = Product::where('user_id',Auth::id())->paginate(10);
        return view('frontend.seller.upload-products', compact('products'));
    }

    public function productEdit($id)
    {
        $categories = Category::where('status',1)->get();
        $product = Product::find($id);
        return view('frontend.seller.upload-product-edit', compact('product','categories'));
    }


    public function productUpdate(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:1',
            'file'        => 'nullable|mimes:eps,psd,jpg,jpeg|max:256000',
            'description' => 'nullable|string',
            'tags' => 'nullable',
            'type' => 'required',
        ]);

        if ($request->tags !== null) {
            $tags = json_encode($request->tags);
        } else {
            $tags = $product->tags;
        }

        $data = [
            'title'       => $request->title,
            'category_id' => $request->category_id,
            'type'       => $request->type,
            'price'       => $request->price,
            'tags' => $tags,
            'description' => $request->description,
        ];

        // File upload only if new file is provided
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $ext = strtolower($file->getClientOriginalExtension());
            $sizeMB = $file->getSize() / 1048576;

            if ($ext === 'eps' && ($sizeMB < 0.5 || $sizeMB > 80)) {
                return back()->withErrors(['file' => 'EPS file must be between 0.5MB and 80MB.'])->withInput();
            }
            if ($ext === 'psd' && ($sizeMB < 1.5 || $sizeMB > 250)) {
                return back()->withErrors(['file' => 'PSD file must be between 1.5MB and 250MB.'])->withInput();
            }
            if (in_array($ext, ['jpg', 'jpeg']) && ($sizeMB < 1.5 || $sizeMB > 250)) {
                return back()->withErrors(['file' => 'JPG file must be between 1.5MB and 250MB.'])->withInput();
            }
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '-' . time() . '.' . $ext;
            $path = 'uploads/products/'.$filename;
            $file->move(public_path('uploads/products'), $filename);

            // Delete old file if exists
            if (file_exists(public_path($product->file_path))) {
                unlink(public_path($product->file_path));
            }

            $data['file_path'] = $path;
            $data['file_name'] = $filename;
            $data['file_type'] = $file->getClientMimeType();
        }

        $product->update($data);

        return redirect()->route('designer.product-list')->with('success', 'Product updated successfully!');
    }

    public function productDelete($id)
    {
        $product = Product::findOrFail($id);
        if ($product->file_path && file_exists(public_path($product->file_path))) {
            unlink(public_path($product->file_path));
        }
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully!');
    }





    public function manageProfile()
    {
        $user = User::findOrFail(Auth::id());
        return view('frontend.seller.manageProfile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $data = $request->except('image');
        $user->update($data);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/designer/'), $filename);
            $user->image = 'uploads/designer/' . $filename;
            $user->save();
        }
        return redirect()->back()->with('success', 'Designer Profile Updated Successfully.');
    }


    public function changePassword()
    {
        $user = User::findOrFail(Auth::id());
        return view('frontend.seller.changePassword', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::findOrFail(Auth::id());

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Your current password is incorrect.');
        }

        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success', 'Password updated successfully!');
    }





}
