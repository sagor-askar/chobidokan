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
        $categories = Category::where('status',1)->get();
        return view('frontend.menu.fileUpload',compact('categories'));
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
        ]);

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

//        if ($request->type == 1 && ($sizeMB < 0.1 || $sizeMB > 25)) {
//            return back()->withErrors(['file' => 'Image must be between 0.1MB and 25MB.'])->withInput();
//        }
//
//        if ($request->type == 2 && ($sizeMB < 1 || $sizeMB > 250)) {
//            return back()->withErrors(['file' => 'Video must be between 1MB and 250MB.'])->withInput();
//        }

        $filename = time().'_'.uniqid().'.'.$ext;
        $path = 'uploads/products/'.$filename;
        $file->move(public_path('uploads/products'), $filename);

        Product::create([
            'title'       => $request->title,
            'category_id' => $request->category_id,
            'user_id'     => Auth::id(),
            'price'       => $request->price,
            'type'        => $request->type,
            'description' => $request->description,
            'file_path'   => $path,
            'file_name'   => $filename,
            'file_type'   => $file->getClientMimeType(),
        ]);

        return redirect()->back()->with('success', 'Product uploaded successfully!');
    }
}
