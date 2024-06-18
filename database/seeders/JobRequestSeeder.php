<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\job_request;

class JobRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $job_request_seed = [
            ['id' => '1', 
            'job_request_id' => '30001', 
            'cust_id' => '840517130566', 
            'job_description' => 'Baby Sitting', 
            'job_period' => '7 days', 
            'make_bidding' => '7.00'],
        ];

        foreach ($job_request_seed as $seed) {
            job_request::firstOrCreate($seed);
        }
    }
}
