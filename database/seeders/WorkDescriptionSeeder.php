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
    public function run(): void
    {
        //
        $work_description_seed = [
            [
            'id' => '1',
            'work_description_id' => '90001',
            'work_description' => 'Baby Sitting',
            'work_period' => '02/06/2024 - 09/06/2024',
            ]
        ];

        foreach ($work_description_seed as $seed) {
            work_description::firstOrCreate($seed);
        }
    }
}
