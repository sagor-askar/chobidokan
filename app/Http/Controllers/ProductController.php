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
            'file'        => 'required|mimes:eps,psd,jpg,jpeg|max:256000',
            'description' => 'nullable|string',
        ]);

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

        $filename = time().'_'.uniqid().'.'.$ext;
        $path = 'uploads/products/'.$filename;
        $file->move(public_path('uploads/products'), $filename);


        Product::create([
            'title'       => $request->title,
            'category_id' => $request->category_id,
            'user_id'     => Auth::id(),
            'price'       => $request->price,
            'description' => $request->description,
            'file_path'   => $path,
            'file_name'   => $filename,
            'file_type'   => $file->getClientMimeType(),
        ]);

        return redirect()->back()->with('success', 'Product uploaded successfully!');
    }
}
