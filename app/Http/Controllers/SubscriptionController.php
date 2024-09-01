<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\PaymentPlatform;
use App\Models\Subscription;
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
    public function approval(Request $request)
    {
       $rules = [
        'plan'=> ['required', 'exists:plans,slug']
       ];

       $request->validate($rules);

       $plan = Plan::where('slug', $request->plan)->firstOrFail();
       $user = $request->user();
       $subscription = Subscription::create([
        'active_until'=> now()->addDays($plan->duration_in_days),
        'user_id'=> $user->id,
        'plan_id'=> $plan->id,
       ]);

       return redirect()
       ->route('home')
       ->withSuccess(['payment'=>"Thanks, {$user->name}. You have now a {$plan->slug} subscription. Start using it now."]);
    }
    public function cancelled()
    {
        return redirect()
            ->route('subscribe.show')
            ->withErrors('We cannot process your subscription. Please try again when you\'re ready.');
    }
}
