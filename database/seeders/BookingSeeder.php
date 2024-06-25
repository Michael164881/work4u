<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\booking;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // //
        // $booking_seed = [
        //     ['id' => '1', 
        //     'booking_id' => '1001', 
        //     'cust_id' => '2001', 
        //     'job_request_id' => '3001', 
        //     'work_profile_id' => '4001', 
        //     'booking_status' => 'Pending', 
        //     'bidding_status' => 'Successfull', 
        //     'notification_id' => '6001', 
        //     'booking_start_date' => '2024-06-10', 
        //     'booking_end_date' => '2024-06-17', 
        //     'booking_fee' => '150.00'],

        //     ['id' => '2', 
        //     'booking_id' => '1002', 
        //     'cust_id' => '2002', 
        //     'job_request_id' => '3002', 
        //     'work_profile_id' => '4002', 
        //     'booking_status' => 'Successfull',
        //     'bidding_status' => 'Pending', 
        //     'notification_id' => '60002', 
        //     'booking_start_date' => '2024-06-15', 
        //     'booking_end_date' => '2024-06-20', 
        //     'booking_fee' => '200.00'],
        // ];

        // foreach ($booking_seed as $seed) {
        //     booking::firstOrCreate($seed);
        // }
    }
}
