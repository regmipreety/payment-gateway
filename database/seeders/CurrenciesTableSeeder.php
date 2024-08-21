<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            'usd',
            'eur',
            'aud',
            'jpy',
        ];

        foreach( $currencies as $currency) {
            Currency::create([
                'iso' => $currency
            ]);
        }
    }
}
