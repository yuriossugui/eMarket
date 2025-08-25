<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = session('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();
        return view('Store.cart', compact('products', 'cart'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $quantity = max(1, min($request->input('quantity', 1), $product->stock));
        $cart = session('cart', []);
        if (isset($cart[$id])) {
            $cart[$id] += $quantity;
        } else {
            $cart[$id] = $quantity;
        }
        // Limita ao estoque disponível
        $cart[$id] = min($cart[$id], $product->stock);
        session(['cart' => $cart]);
        return redirect()->route('store.show', $id)->with('success', 'Produto adicionado ao carrinho!');
    }

    public function remove(Request $request, $id)
    {
        $cart = session('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }
        return redirect()->route('cart.index')->with('success', 'Produto removido do carrinho!');
    }
}
