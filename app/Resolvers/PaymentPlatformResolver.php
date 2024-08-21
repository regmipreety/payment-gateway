<?php
namespace App\Resolvers;
use App\Models\PaymentPlatform;

class PaymentPlatformResolver
{
    protected $paymentPlatforms;
    public function __construct()
    {
        $this->paymentPlatforms = PaymentPlatform::all();


    }
    public function resolveService($paymentPlatformName)
    {
        $name = strtolower($this->paymentPlatforms->where('namelower',strtolower($paymentPlatformName))->first()['name']);

        $service = config("services.{$name}.class");

        if ($service) {
            return resolve($service);
        }

        throw new \Exception("The selected platform is not in the configuration.");
    }
}