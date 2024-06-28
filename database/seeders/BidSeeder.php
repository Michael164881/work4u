<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\bid;
use Illuminate\Support\Facades\DB;

class BidSeeder extends Seeder
{
    public function run()
    {
        $bids = [
            [
                'freelancer_profile_id' => 1,
                'job_request_id' => 1,
                'bid_amount' => 2900.00,
            ],
            [
                'freelancer_profile_id' => 2,
                'job_request_id' => 1,
                'bid_amount' => 3000.00,
            ],
            [
                'freelancer_profile_id' => 3,
                'job_request_id' => 2,
                'bid_amount' => 750.00,
            ],
            [
                'freelancer_profile_id' => 1,
                'job_request_id' => 2,
                'bid_amount' => 800.00,
            ],
            [
                'freelancer_profile_id' => 2,
                'job_request_id' => 3,
                'bid_amount' => 500.00,
            ],
        ];

        foreach ($bids as $bid) {
            bid::create($bid);
        }
    }
}