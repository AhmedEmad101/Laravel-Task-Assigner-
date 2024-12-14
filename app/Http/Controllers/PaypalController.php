<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
class PaypalController extends Controller
{
  public function Payment(Request $request)
  {
    $id = 1;
    $x = 50;
    $data = [];
    $data['items'] = [
        [
            'name' => 'Buying the Property',
            'price' => '50',
            'desc'  => 'Buying Property',
            'qty' => 1
        ]
    ];

    $data['invoice_id'] = $id;
    $data['invoice_description'] =
    "Order {$data['invoice_id']} Invoice {$x}
    For {$x},
       ";
    $data['return_url'] = 'http://localhost/TaskAssigner/public/PaymentSuccess';
    $data['cancel_url'] = route('PC');
    $data['total'] = 50;

    $provider = new ExpressCheckout;

    $response = $provider->setExpressCheckout($data);

    $response = $provider->setExpressCheckout($data, true);

    return redirect($response['paypal_link']);
}
public function PaymentCancel()
    {
        return response()->json('PaymentCanceled',402);
    }
    public function PaymentSuccess(Request $request)
    {

        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);
        if(in_array(strtoupper($response['ACK']),['SUCCESS','SUCCESSWITHWARNING']))
        {
           return response()->json('Successful Payment Your Payment on the Property has been done successfully',200);
        }
        else{
           return response()->json('failed payment', 402);


    }
  }

}
