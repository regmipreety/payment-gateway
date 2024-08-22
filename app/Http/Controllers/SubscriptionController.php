<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\PaymentPlatform;

class SubscriptionController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
    public function show()
    {
        $paymentPlatforms = PaymentPlatform::where('subscription_enabled', false)->get();
        return view('subscribe')->with([
            'plans' => Plan::all(),
            'paymentPlatforms' => PaymentPlatform::all(),
        ]);
    }
    public function store()
    {

    }
    public function approval()
    {

    }
    public function cancelled()
    {

    }
}
