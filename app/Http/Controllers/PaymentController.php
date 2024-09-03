<?php

namespace App\Http\Controllers;

use App\Resolvers\PaymentPlatformResolver;
use App\Services\PaypalService;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    /** 
     * @var PaymentPlatformResolver paymentPlatformResolver
     */
    protected $paymentPlatformResolver;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PaymentPlatformResolver $paymentPlatformResolver)
    {
        $this->middleware('auth');
        $this->paymentPlatformResolver = $paymentPlatformResolver;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pay(Request $request)
    {
        $rules = [
            'value' => ['required', 'numeric', 'min:5'],
            'currency' => ['required', 'exists:currencies,iso'],
            'payment_platform' => ['required', 'exists:payment_platforms,name'],
        ];

        $request->validate($rules);
        $paymentPlatform = $this->paymentPlatformResolver
            ->resolveService($request->payment_platform);

        Session()->put('paymentPlatform', $request->payment_platform);
        return $paymentPlatform->handlePayment($request);
        
    }

    public function approval()
    {
        if (session()->has('paymentPlatform')) {
            $paymentPlatform = $this->paymentPlatformResolver
                ->resolveService(session()->get('paymentPlatform'));

            return $paymentPlatform->handleApproval();
        } else {
            return redirect()
                ->route('home')
                ->withErrors('We cannot retrieve your payment platform');
        }


    }

    public function cancelled()
    {
        return redirect()
            ->route('home')
            ->withErrors('The Payment was cancelled.');
    }

}
