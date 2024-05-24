<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $products = Product::get();

        $cart = session()->get('cart');
        if ($cart == null)
            $cart = [];

        return view('store.index')->with('products', $products)->with('cart', $cart);
    }



}