<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productList()
    {

        // $products = Product::paginate(10);
        $approvedProducts = Product::where('status', 1)
                                   ->paginate(10);

        $newProducts = Product::where('status', 0)
                                   ->paginate(10);

        return view('admin.product.product-list', compact('approvedProducts', 'newProducts'));
    }

    public function productChangeStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->status = $product->status == 1 ? 0 : 1;
        $product->save();
        return redirect()->back()->with('success', 'Status Changed successfully.');
    }

    public function productShow($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.show', compact('product'));
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
}
