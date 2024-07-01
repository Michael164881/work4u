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
            [
                'id' => 1, 
                'user_id' => 8,
                'booking_id' => null, 
                'work_description_id' => null, 
                'job_request_id' => null, 
                'bids_id' => null, 
                'notification_info' => 'Low balance', 
            ],
            [
                'id' => 2, 
                'user_id' => 8, 
                'booking_id' => 1, 
                'work_description_id' => null, 
                'job_request_id' => null, 
                'bids_id' => null, 
                'notification_info' => 'successfully booked', 
            ],
            [
                'id' => 3, 
                'user_id' => 8, 
                'booking_id' => 2, 
                'work_description_id' => null, 
                'job_request_id' => null, 
                'bids_id' => null, 
                'notification_info' => 'booking completed', 
            ],
            [
                'id' => 4, 
                'user_id' => 8, 
                'booking_id' => 2, 
                'work_description_id' => null, 
                'job_request_id' => null, 
                'bids_id' => null, 
                'notification_info' => 'booking cancelled', 
            ],
            [
                'id' => 5, 
                'user_id' => 2, 
                'booking_id' => null, 
                'work_description_id' => 1, 
                'job_request_id' => null, 
                'bids_id' => null, 
                'notification_info' => 'work description updated', 
            ],
            [
                'id' => 6, 
                'user_id' => 2, 
                'booking_id' => null, 
                'work_description_id' => 1, 
                'job_request_id' => null, 
                'bids_id' => null, 
                'notification_info' => 'work description created', 
            ],
            [
                'id' => 7, 
                'user_id' => 8, 
                'booking_id' => null, 
                'work_description_id' => null, 
                'job_request_id' => 1, 
                'bids_id' => null, 
                'notification_info' => 'job request updated', 
            ],
            [
                'id' => 8, 
                'user_id' => 8, 
                'booking_id' => null, 
                'work_description_id' => null, 
                'job_request_id' => 2, 
                'bids_id' => null, 
                'notification_info' => 'job request created', 
            ],
            [
                'id' => 9, 
                'user_id' => 2, 
                'booking_id' => null, 
                'work_description_id' => null, 
                'job_request_id' => null, 
                'bids_id' => 1, 
                'notification_info' => 'bid created', 
            ],
            [
                'id' => 10, 
                'user_id' => 2, 
                'booking_id' => null, 
                'work_description_id' => null, 
                'job_request_id' => null, 
                'bids_id' => 2, 
                'notification_info' => 'bid updated', 
            ],
        ];

        foreach ($notification_seed as $seed) {
            notification::firstOrCreate($seed);
        }
    }
}
