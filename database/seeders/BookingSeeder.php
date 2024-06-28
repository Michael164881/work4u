<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookings = [
            [
                'id' => 1,
                'created_at' => Carbon::parse('2024-06-27 10:47:08'),
                'updated_at' => Carbon::parse('2024-06-27 10:47:08'),
                'user_id' => 8,
                'job_request_id' => 0,
                'work_profile_id' => 7,
                'booking_status' => 'pending',
                'notification_id' => null,
                'booking_start_date' => Carbon::parse('2024-06-27 10:47:08'),
                'booking_end_date' => Carbon::parse('2024-07-02 10:47:08'),
                'booking_fee' => 300.00,
                'freelancer_profile_id' => 1 // Add appropriate freelancer_profile_id
            ],
            [
                'id' => 2,
                'created_at' => Carbon::parse('2024-06-27 10:47:23'),
                'updated_at' => Carbon::parse('2024-06-27 10:47:23'),
                'user_id' => 8,
                'job_request_id' => 0,
                'work_profile_id' => 3,
                'booking_status' => 'pending',
                'notification_id' => null,
                'booking_start_date' => Carbon::parse('2024-06-27 10:47:23'),
                'booking_end_date' => Carbon::parse('2024-07-07 10:47:23'),
                'booking_fee' => 500.00,
                'freelancer_profile_id' => 2 // Add appropriate freelancer_profile_id
            ],
            [
                'id' => 3,
                'created_at' => Carbon::parse('2024-06-27 12:24:46'),
                'updated_at' => Carbon::parse('2024-06-27 12:24:46'),
                'user_id' => 8,
                'job_request_id' => 0,
                'work_profile_id' => 1,
                'booking_status' => 'cancelled',
                'notification_id' => null,
                'booking_start_date' => Carbon::parse('2024-06-27 12:24:46'),
                'booking_end_date' => Carbon::parse('2024-07-27 12:24:46'),
                'booking_fee' => 1500.00,
                'freelancer_profile_id' => 3 // Add appropriate freelancer_profile_id
            ],
            [
                'id' => 4,
                'created_at' => Carbon::parse('2024-06-27 12:34:48'),
                'updated_at' => Carbon::parse('2024-06-27 12:34:48'),
                'user_id' => 8,
                'job_request_id' => 0,
                'work_profile_id' => 4,
                'booking_status' => 'pending',
                'notification_id' => null,
                'booking_start_date' => Carbon::parse('2024-06-27 12:34:48'),
                'booking_end_date' => Carbon::parse('2024-07-17 12:34:48'),
                'booking_fee' => 800.00,
                'freelancer_profile_id' => 4 // Add appropriate freelancer_profile_id
            ]
        ];

        DB::table('booking')->insert($bookings);
    }
}
