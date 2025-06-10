<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index(){

        $products = Product::all();
        $products_json = json_encode($products);

        $clients = User::select('role')
        ->selectRaw('COUNT(*) as total')
        ->groupBy('role')
        ->get();

        return view('Admin.dashboard',['products'=>$products_json,'clients'=>$clients]);
    }
}
