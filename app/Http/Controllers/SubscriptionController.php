<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\PaymentPlatform;
use App\Resolvers\PaymentPlatformResolver;

class SubscriptionController extends Controller
{
    protected $paymentPlatformResolver;
    public function __construct(PaymentPlatformResolver $paymentPlatformResolver)
    {
        $this->middleware("auth");
        $this->paymentPlatformResolver = $paymentPlatformResolver;
    }
    public function show()
    {
        $paymentPlatforms = PaymentPlatform::where('subscription_enabled', true)->get();
        return view('subscribe')->with([
            'plans' => Plan::all(),
            'paymentPlatforms' => $paymentPlatforms,
        ]);
    }
    public function store(Request $request)
    {
        $rules = [
            'plan' => ['required', 'exists:plans,slug'],
            'payment_platform' => ['required', 'exists:payment_platforms,name'],

        ];
        
        $request->validate($rules);
        $paymentPlatform = $this->paymentPlatformResolver
            ->resolveService($request->payment_platform);
        Session()->put('subscriptionPlatformId', $request->payment_platform);
        return $paymentPlatform->handleSubscription($request);

    }
    public function approval()
    {

    }
    public function cancelled()
    {

    }
}
