<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\work_description;

class WorkDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $workDescription = [
            [
                'freelancer_id' => 1,
                'work_description_name' => 'Web Development',
                'work_description' => 'Developed various web applications using Laravel.',
                'work_fee' => 1500.00,
                'work_period' => 30,
                'work_description_image' => null
            ],
            [
                'freelancer_id' => 1,
                'work_description_name' => 'API Development',
                'work_description' => 'Created RESTful APIs for multiple clients.',
                'work_fee' => 1200.00,
                'work_period' => 25,
                'work_description_image' => null
            ],
            [
                'freelancer_id' => 2,
                'work_description_name' => 'Logo Design',
                'work_description' => 'Designed logos for various brands.',
                'work_fee' => 500.00,
                'work_period' => 10,
                'work_description_image' => null
            ],
            [
                'freelancer_id' => 2,
                'work_description_name' => 'Brand Identity',
                'work_description' => 'Created brand identities for startups.',
                'work_fee' => 800.00,
                'work_period' => 20,
                'work_description_image' => null
            ],
            [
                'freelancer_id' => 3,
                'work_description_name' => 'Social Media Marketing',
                'work_description' => 'Managed social media campaigns for businesses.',
                'work_fee' => 1000.00,
                'work_period' => 15,
                'work_description_image' => null
            ],
            [
                'freelancer_id' => 3,
                'work_description_name' => 'SEO Optimization',
                'work_description' => 'Improved SEO rankings for various websites.',
                'work_fee' => 1200.00,
                'work_period' => 20,
                'work_description_image' => null
            ],
            [
                'freelancer_id' => 4,
                'work_description_name' => 'Content Writing',
                'work_description' => 'Written articles and blog posts for various niches.',
                'work_fee' => 300.00,
                'work_period' => 5,
                'work_description_image' => null
            ],
            [
                'freelancer_id' => 4,
                'work_description_name' => 'Editing and Proofreading',
                'work_description' => 'Edited and proofread manuscripts and articles.',
                'work_fee' => 400.00,
                'work_period' => 7,
                'work_description_image' => null
            ],
            [
                'freelancer_id' => 5,
                'work_description_name' => 'Video Editing',
                'work_description' => 'Edited promotional and educational videos.',
                'work_fee' => 800.00,
                'work_period' => 10,
                'work_description_image' => null
            ],
            [
                'freelancer_id' => 5,
                'work_description_name' => 'Animation',
                'work_description' => 'Created animations for various projects.',
                'work_fee' => 1500.00,
                'work_period' => 25,
                'work_description_image' => null
            ],
            [
                'freelancer_id' => 6,
                'work_description_name' => 'Project Management',
                'work_description' => 'Managed projects from initiation to closure.',
                'work_fee' => 2000.00,
                'work_period' => 40,
                'work_description_image' => null
            ],
            [
                'freelancer_id' => 6,
                'work_description_name' => 'Team Coordination',
                'work_description' => 'Coordinated teams to ensure timely delivery.',
                'work_fee' => 1800.00,
                'work_period' => 35,
                'work_description_image' => null
            ],
        ];

        foreach ($workDescription as $workDescription) {
            work_description::firstOrCreate($workDescription);
        }
    }
}
