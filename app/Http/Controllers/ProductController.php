<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function uploadProduct()
    {
        $categories = Category::where("type",1)->where('status',1)->get();
        $settings = Setting::first();
        return view('frontend.menu.fileUpload',compact('categories','settings'));
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255'
        ]);

        $category = Category::create([
            'name'=>$request->name,
            'type'=>1,
            'status'=>1
        ]);
        return response()->json([
            'success'=>true,
            'category'=>$category
        ]);
    }


    public function storeProduct(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price'       => $request->has('is_free') ? 'nullable|numeric|min:0' : 'required|numeric|min:0',
            'file'        => 'required|file',
            'type'        => 'required|in:1,2', // 1=image, 2=video
            'description' => 'nullable|string',
            'tags'        => 'nullable',
            'is_free'     => 'nullable|in:1',
        ]);

        if ($request->tags) {
            $tags =  json_encode($request->tags);
        }else{
            $tags = NULL;
        }

        $isFree = $request->has('is_free') ? 1 : 0;
        $price = $isFree ? 0 : $request->price;

        $assetId = mt_rand(100000000, 999999999);

        $file = $request->file('file');
        $ext = strtolower($file->getClientOriginalExtension());
        $sizeMB = $file->getSize() / 1048576;

        $allowedImages = ['jpg', 'jpeg', 'png', 'gif'];
        $allowedVideos = ['mp4', 'mov', 'avi', 'mkv'];

        if ($request->type == 1 && !in_array($ext, $allowedImages)) {
            return back()->withErrors(['file' => 'Please upload a valid image file.'])->withInput();
        }

        if ($request->type == 2 && !in_array($ext, $allowedVideos)) {
            return back()->withErrors(['file' => 'Please upload a valid video file.'])->withInput();
        }



        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
            . '-' . time() . '.' . $ext;
        $storagePath = 'uploads/products/' . $filename;

        $file->storeAs('uploads/products', $filename);

        Product::create([
            'title'       => $request->title,
            'asset_id'    => $assetId,
            'category_id' => $request->category_id,
            'designer_id' => Auth::id(),
            'price'       => $price,
            'is_free'     => $isFree,
            'type'        => $request->type,
            'tags'        => $tags,
            'description' => $request->description,
            'file_path'   => $storagePath,
            'file_name'   => $filename,
            'file_type'   => $file->getClientMimeType(),
        ]);

        return redirect()->back()->with('success', 'Product uploaded successfully!');
    }
}
