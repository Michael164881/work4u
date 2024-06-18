<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\freelancer;

class FreelancerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $freelancer_seed = [
            ['id' => '1', 
            'flancer_id' => '010245130544', 
            'flancer_name' => 'Syaza Shahira', 
            'flancer_gender' => 'F', 
            'flancer_age' => '30', 
            'flancer_email' => 'syaza123@gmail.com', 
            'flancer_phone_no' => '0152487632', 
            'flancer_password' => 'syaza12345', 
            'flancer_location' => 'No. 1, Persiaran Multimedia, Seksyen 7, Jalan Plumbum 7/102, I-City, 40000 Shah Alam, Selangor', 
            'flancer_work_experience' => 'Baby Sitting', 
            'flancer_edu_quality' => 'Degree', 
            'flancer_nickname' => 'Aza_Ahiha4u'],
        ];

        foreach ($freelancer_seed as $seed) {
            freelancer::firstOrCreate($seed);
        }
    }
}
