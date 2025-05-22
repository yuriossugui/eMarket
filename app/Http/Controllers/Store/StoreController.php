<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class StoreController extends Controller
{
    function index(Request $request)
    {
        
        $products = Product::with('category')->get();
        
        return view('Store.index',['products'=>$products]);
    }
}
