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
        $jobRequests = [
            [
                'user_id' => 8,
                'job_name' => 'Mobile App Development',
                'job_description' => 'Develop a native mobile application for iOS and Android.',
                'job_period' => '20',
                'initial_price' => 3000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 8,
                'job_name' => 'SEO Optimization',
                'job_description' => 'Optimize website content and meta tags for search engines.',
                'job_period' => '5',
                'initial_price' => 800.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 8,
                'job_name' => 'Content Writing',
                'job_description' => 'Write blog articles and website content.',
                'job_period' => '10',
                'initial_price' => 500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more seed data as needed
        ];

        foreach ($jobRequests as $jobRequest) {
            job_request::firstOrCreate($jobRequest);
        }
    }
}
