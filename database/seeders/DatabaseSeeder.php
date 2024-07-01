<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            BookingSeeder::class,
            CustomerSeeder::class,
            JobRequestSeeder::class,
            NotificationSeeder::class,
            FreelancerProfileSeeder::class,
            WorkDescriptionSeeder::class,
            TaskChecklistsSeeder::class,
            BidSeeder::class,
    ]);
    }
}
