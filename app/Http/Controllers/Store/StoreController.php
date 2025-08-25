<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        // Remove "R$" and convert to float
        $min_price = $request->filled('min_price') ? floatval(str_replace(['R$', '.', ','], ['', '', '.'], preg_replace('/[^\d,\.]/', '', $request->min_price))) : null;
        $max_price = $request->filled('max_price') ? floatval(str_replace(['R$', '.', ','], ['', '', '.'], preg_replace('/[^\d,\.]/', '', $request->max_price))) : null;

        $query = Product::query();

        // Only select products where stock > 0
        $query->where('stock', '>', 0);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if (!is_null($min_price) && !is_null($max_price)) {
            $query->whereBetween('price', [$min_price, $max_price]);
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->get();
        $categories = Category::all();

        return view('Store.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('Store.show', compact('product'));
    }

}
