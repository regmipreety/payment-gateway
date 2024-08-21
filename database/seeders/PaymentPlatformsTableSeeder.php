<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentPlatform;

class PaymentPlatformsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentPlatform::create([
            'name' => 'PayPal',
            'namelower' => 'paypal',
            'image' => 'img/payment-platforms/paypal.png'
        ]);

        PaymentPlatform::create([
            'name' => 'Stripe',
            'namelower' => 'stripe',
            'image' => 'img/payment-platforms/stripe.png'
        ]);
    }
}
