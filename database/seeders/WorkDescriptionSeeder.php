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
                'work_address' => 'No. 8, Jalan USJ 9/3B, Subang Business Centre, 47620 Subang Jaya, Selangor, Malaysia',
                'work_status' => 'available',
                'work_description_image' => 'images/work_description_pictures/1719504588.jpg'
            ],
            [
                'freelancer_id' => 1,
                'work_description_name' => 'API Development',
                'work_description' => 'Created RESTful APIs for multiple clients.',
                'work_fee' => 1200.00,
                'work_period' => 25,
                'work_address' => 'No. 34, Lorong Turi 4C, Taman Gembira, 41200 Klang, Selangor, Malaysia',
                'work_status' => 'available',
                'work_description_image' => null
            ],
            [
                'freelancer_id' => 2,
                'work_description_name' => 'Logo Design',
                'work_description' => 'Designed logos for various brands.',
                'work_fee' => 500.00,
                'work_period' => 10,
                'work_address' => 'No. 5, Jalan Kasuarina 2/KS7, Bandar Botanic, 41200 Klang, Selangor, Malaysia',
                'work_status' => 'available',
                'work_description_image' => 'images/work_description_pictures/1719504597.jpg'
            ],
            [
                'freelancer_id' => 2,
                'work_description_name' => 'Brand Identity',
                'work_description' => 'Created brand identities for startups.',
                'work_fee' => 800.00,
                'work_period' => 20,
                'work_address' => 'No. 18, Jalan SS 2/72, SS 2, 47300 Petaling Jaya, Selangor, Malaysia',
                'work_status' => 'available',
                'work_description_image' => null
            ],
            [
                'freelancer_id' => 3,
                'work_description_name' => 'Social Media Marketing',
                'work_description' => 'Managed social media campaigns for businesses.',
                'work_fee' => 1000.00,
                'work_period' => 15,
                'work_address' => 'No. 22, Jalan PJU 1/43, Aman Suria Damansara, 47301 Petaling Jaya, Selangor, Malaysia',
                'work_status' => 'available',
                'work_description_image' => null
            ],
            [
                'freelancer_id' => 3,
                'work_description_name' => 'SEO Optimization',
                'work_description' => 'Improved SEO rankings for various websites.',
                'work_fee' => 1200.00,
                'work_period' => 20,
                'work_address' => 'No. 7, Jalan 5, Taman Putra, 68000 Ampang, Selangor, Malaysia',
                'work_status' => 'available',
                'work_description_image' => null
            ],
            [
                'freelancer_id' => 4,
                'work_description_name' => 'Content Writing',
                'work_description' => 'Written articles and blog posts for various niches.',
                'work_fee' => 300.00,
                'work_period' => 5,
                'work_address' => 'No. 15, Jalan Wawasan 4/2, Bandar Baru Ampang, 68000 Ampang, Selangor, Malaysia',
                'work_status' => 'available',
                'work_description_image' => null
            ],
            [
                'freelancer_id' => 4,
                'work_description_name' => 'Editing and Proofreading',
                'work_description' => 'Edited and proofread manuscripts and articles.',
                'work_fee' => 400.00,
                'work_period' => 7,
                'work_address' => 'No. 9, Jalan TIB 3, Taman Industri Bolton, 68100 Batu Caves, Selangor, Malaysia',
                'work_status' => 'available',
                'work_description_image' => null
            ],
            [
                'freelancer_id' => 5,
                'work_description_name' => 'Video Editing',
                'work_description' => 'Edited promotional and educational videos.',
                'work_fee' => 800.00,
                'work_period' => 10,
                'work_address' => 'No. 21, Jalan Samudra Utara 2, Taman Samudra, 68100 Batu Caves, Selangor, Malaysia',
                'work_status' => 'available',
                'work_description_image' => 'images/work_description_pictures/1719504603.jpg'
            ],
            [
                'freelancer_id' => 5,
                'work_description_name' => 'Animation',
                'work_description' => 'Created animations for various projects.',
                'work_fee' => 1500.00,
                'work_period' => 25,
                'work_address' => 'No. 16, Jalan Meranti Jaya 7/2, Taman Meranti Jaya, 47120 Puchong, Selangor, Malaysia',
                'work_status' => 'available',
                'work_description_image' => null
            ],
            [
                'freelancer_id' => 6,
                'work_description_name' => 'Project Management',
                'work_description' => 'Managed projects from initiation to closure.',
                'work_fee' => 2000.00,
                'work_period' => 40,
                'work_address' => 'No. 11, Jalan 18/38B, Taman Sri Serdang, 43300 Seri Kembangan, Selangor, Malaysia',
                'work_status' => 'available',
                'work_description_image' => null
            ],
            [
                'freelancer_id' => 6,
                'work_description_name' => 'Team Coordination',
                'work_description' => 'Coordinated teams to ensure timely delivery.',
                'work_fee' => 1800.00,
                'work_period' => 35,
                'work_address' => 'No. 4, Jalan Sri Hartamas 8, Sri Hartamas, 50480 Kuala Lumpur, Malaysia',
                'work_status' => 'available',
                'work_description_image' => null
            ],
        ];

        foreach ($workDescription as $workDescription) {
            work_description::firstOrCreate($workDescription);
        }
    }
}
