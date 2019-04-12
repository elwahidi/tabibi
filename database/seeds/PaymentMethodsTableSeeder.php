<?php

use Illuminate\Database\Seeder;

class PaymentMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $methods = ['cache', 'chèque'];

        foreach ($methods as $method) {
            \App\PaymentMethod::create([
                'payment_method' => $method
            ]);
        }
    }
}
