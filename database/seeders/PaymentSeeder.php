<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\payment;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $payment_seed = [
            ['id' => '1', 
            'payment_id' => '11001', 
            'booking_id' => '1001', 
            'wallet_cust_id' => '840517130566' , 
            'wallet_flancer_id' => '010245130544', 
            'payment_method' => 'PayWave', 
            'amount' => '157.00', 
            'notification_id' => '6002'],
        ];

        foreach ($payment_seed as $seed) {
            payment::firstOrCreate($seed);
        }
    }
}
