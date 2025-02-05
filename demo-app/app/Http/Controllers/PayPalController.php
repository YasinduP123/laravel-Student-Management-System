<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Srmklive\PayPal\Facades\PayPal;

class PayPalController extends Controller
{

    public  function index(){
        // dd("Hello World");
        return view(view: 'payments');
    }

    public function paypal(Request $request)
    {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            // "application_context" => [
            //     "return_url" => route('success'),
            //     "cancel_url" => route('cancel')
            // ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->price
                    ]
                ]
            ]
        ]);
        dd(vars: $response);

        // if (isset($response['id']) && $response['id'] !== null) {
        //     foreach ($response['links'] as $link) {
        //         if ($link['rel'] == 'approve') {
        //             session()->put('product_name', $request->product_name);
        //             session()->put('quantity', $request->quantity);
        //             return redirect()->away($link['href']);
        //         }
        //     }
        // } else {
        //     return redirect()->route('cancel');
        // }
    }
}
