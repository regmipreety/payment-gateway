<?php

namespace App\Http\Controllers;

use App\Services\PaypalService;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pay(Request $request)
    {
       $rules = [
        'value'=>['required','numeric','min:5'],
        'currency'=>['required','exists:currencies,iso'],
        'payment_platform'=>['required','exists:payment_platforms,name'],
       ];

       $request->validate($rules);

       $paymentPlatform = resolve(PaypalService::class);
       $payment = $paymentPlatform->handlePayment($request);
       return $payment;
    }

    public function approval(Request $request){
        
    }

    public function cancelled(Request $request){

    }

}
