<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function uploadProduct()
    {
        $categories = Category::where("type",1)->where('status',1)->get();
        return view('frontend.menu.fileUpload',compact('categories'));
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
            'price'       => 'required|numeric|min:1',
            'file'        => 'required|file',
            'type'        => 'required|in:1,2', // 1=image, 2=video
            'description' => 'nullable|string',
            'tags' => 'nullable',
        ]);

        if ($request->tags) {
            $tags =  json_encode($request->tags);
        }else{
            $tags = NULL;
        }

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
            'category_id' => $request->category_id,
            'designer_id'     => Auth::id(),
            'price'       => $request->price,
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
