<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaypalController extends Controller
{
    public function payWithPaypal()
    {
        $cart = session()->get('cart');

        $totalAmount = 0;

        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['qty'];
        }

        $order = new Order();
        $order->user_id = 1;
        $order->amount = $totalAmount;
        $order->save();

        $data = [];

        foreach ($cart as $item) {
            $data['items'] = [
                [
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'desc'  => $item['name'],
                    'qty' => $item['qty'],
                ]
            ];

            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item['id'];
            $orderItem->quantity = $item['qty'];
            $orderItem->amount = $item['price'];
            $orderItem->save();
        }

        $data['invoice_id'] = $order->id;
        $data['invoice_description'] = "Your Order #{$order->id}";
        $data['return_url'] = route('paypal.success');
        $data['cancel_url'] = route('paypal.cancel');
        $data['total'] = $totalAmount;

        $provider = new ExpressCheckout;

        $response = $provider->setExpressCheckout($data);

        $response = $provider->setExpressCheckout($data, true);
        // dd($response);
        return redirect($response['paypal_link']);
    }

    public function paypalSuccess(Request $request)
    {
        $provider = new ExpressCheckout();
        $response=$provider->getExpressCheckoutDetails($request->token);
        if(in_array(strtoupper($response['ACK']),['SUCCESS','SUCCESSWITHWARNING'])){
            session()->remove('cart');
            return 'Payment success!';
        }

        return 'Try again later!';
    }

    public function paypalCancel(Request $request)
    {
        return 'Payment cancel!';
    }
}
