<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\notification;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $notification_seed = [
            ['id' => '1', 
            'notification_id' => '60001', 
            'wallet_flancer_id' => '70001', 
            'cust_id' => '840517130566', 
            'flancer_id' => '010245130544', 
            'wallet_cust_id' => '840517130566', 
            'booking_id' => '10001', 
            'work_profile_id' => '20001', 
            'payment_id' => '8001', 
            'notification_info' => 'Successful'],
        ];

        foreach ($notification_seed as $seed) {
            notification::firstOrCreate($seed);
        }
    }
}
