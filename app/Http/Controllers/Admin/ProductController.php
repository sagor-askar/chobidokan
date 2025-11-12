<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productList()
    {

        $products = Product::paginate(10);
        return view('admin.product.product-list', compact('products'));
    }
}
