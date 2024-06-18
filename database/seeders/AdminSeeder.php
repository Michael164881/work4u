<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $admin_seed = [
            ['admin_id' => '1', 'admin_password' => 'michael123', 'add_job_description' => 'Baby Sitting'],
            ['admin_id' => '2', 'admin_password' => 'kevin123', 'add_job_description' => 'Wash Car'],
            ['admin_id' => '3', 'admin_password' => 'tommy123', 'add_job_description' => 'Housekeeping'],
            ['admin_id' => '4', 'admin_password' => 'naim123', 'add_job_description' => 'Buy Grocery'],
        ];

        foreach ($admin_seed as $seed) {
            admin::firstOrCreate($seed);
        }
    }
}
