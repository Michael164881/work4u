<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\freelancer_profile;

class FreelancerProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $profiles = [
            [
                'user_id' => 2,
                'location' => 'Shah Alam',
                'work_experience' => '5 years of experience in software development.',
                'edu_quality' => 'BSc in Computer Science',
                'nickname' => 'johnny',
                'average_rating' => 4.0,
                'rating_count' => 10,
            ],
            [
                'user_id' => 3,
                'location' => 'Subang Jaya',
                'work_experience' => '3 years of experience in graphic design.',
                'edu_quality' => 'BA in Graphic Design',
                'nickname' => 'jane',
                'average_rating' => 4.5,
                'rating_count' => 15,
            ],
            [
                'user_id' => 4,
                'location' => 'Kuala Lumpur',
                'work_experience' => '4 years of experience in digital marketing.',
                'edu_quality' => 'MBA in Marketing',
                'nickname' => 'rob'
            ],
            [
                'user_id' => 5,
                'location' => 'Klang',
                'work_experience' => '6 years of experience in content writing.',
                'edu_quality' => 'MA in English Literature',
                'nickname' => 'emily'
            ],
            [
                'user_id' => 6,
                'location' => 'Shah Alam',
                'work_experience' => '2 years of experience in video editing.',
                'edu_quality' => 'BA in Film Studies',
                'nickname' => 'mike'
            ],
            [
                'user_id' => 7,
                'location' => 'Klang',
                'work_experience' => '5 years of experience in project management.',
                'edu_quality' => 'PMP Certification',
                'nickname' => 'sarah'
            ],
        ];

        foreach ($profiles as $profile) {
            freelancer_profile::firstOrCreate($profile);
        }
    }
}
