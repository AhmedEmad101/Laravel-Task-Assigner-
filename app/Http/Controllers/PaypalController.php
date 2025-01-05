<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\Tier;
use App\Models\User;
use Srmklive\PayPal\Services\ExpressCheckout;
use Carbon\Carbon;
class PaypalController extends Controller
{


  public function Payment($id , Request $request)
  {
    $tier = Tier::find($id);
    session()->put("uid", $request->input("UserId"));
    $data = [];
    $data['items'] = [
        [
            'name' => 'Subscrption tier '.$tier->name,
            'price' => $tier->price,
            'desc'  => 'Buying Subscrption',
            'qty' => 1
        ]
    ];

    $data['invoice_id'] = $tier->id;
    $data['invoice_description'] =
    "Order {$data['invoice_id']} Invoice {$tier->price}
    For {$tier->price},
       ";
    $data['return_url'] = 'http://localhost/TaskAssigner/public/PaymentSuccess/'. $tier->id;
    $data['cancel_url'] = route('PC');
    $data['total'] = $tier->price;

    $provider = new ExpressCheckout;

    $response = $provider->setExpressCheckout($data);

    $response = $provider->setExpressCheckout($data, true);

    return redirect($response['paypal_link']);
}
public function PaymentCancel()
    {
        return response()->json('PaymentCanceled',402);
    }
    public function PaymentSuccess(Request $request,$tier)
    {
        $date = Carbon::now();

        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);
        if(in_array(strtoupper($response['ACK']),['SUCCESS','SUCCESSWITHWARNING']))
        {
           $userid = session()->get('SubId');
           $user = User::find($userid);
           $usertier = Tier::find($tier);
           if($user->Subscription->Tier->id != $tier && $user->Subscription->Tier->count() == 0){
           $Subscription = Subscription::create(
            [
                'user_Id'=> $userid,
                'tier_id'=> $tier,
                'expires_at'=>$date->addMonth()
            ]
        );
        $Subscription->save();

        return redirect()->back()->with('firstsub','You have subscriped in '.$usertier->name.' tier subscription');
    }
    return redirect()->back()->with('alreadysub','You already have a ' .$user->Subscription->Tier->name .' subscription');
        }


        else{
           return response()->json('failed payment', 402);


    }


}
}
