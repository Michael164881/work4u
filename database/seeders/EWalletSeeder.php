<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ewallet;

class EWalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $ewallet_seed = [
            ['id' => '1', 
            'wallet_cust_id' => '840517130566', 
            'wallet_flancer_id' => 'michael123', 
            'ewallet_balance' => '4.00', 
            'notification_id' => '60001'],
        ];

        foreach ($ewallet_seed as $seed) {
            ewallet::firstOrCreate($seed);
        }
    }
}
