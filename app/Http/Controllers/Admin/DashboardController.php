<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index(){

        $products = Product::all();

        $products_json = json_encode($products);

        return view('Admin.dashboard',['products'=>$products_json]);
    }
}
