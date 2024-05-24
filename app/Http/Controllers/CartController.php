<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\ExpressCheckout;
class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart');
        if ($cart == null)
            $cart = [];

        return view('cart.index')->with('cart', $cart);
    }
    
    public function addToCart(Request $request)
    {
    
        session()->put('cart', $request->post('cart'));

        return response()->json([
            'status' => 'added',
            'data'=>$request->cart
        ]);
    }


   

}