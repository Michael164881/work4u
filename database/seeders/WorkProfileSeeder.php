<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\work_profile;

class WorkProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $work_profile_seed = [
            ['id' => '1', 
            'work_profile_id' => '40001', 
            'flancer_id' => '010245130544', 
            'work_fee' => '50.00', 
            'location' => 'No. 1, Persiaran Multimedia, Seksyen 7, Jalan Plumbum 7/102, I-City, 40000 Shah Alam, Selangor', 
            'work_description' => 'Baby Sitting'],
        ];

        foreach ($work_profile_seed as $seed) {
            work_profile::firstOrCreate($seed);
        }
    }
}
