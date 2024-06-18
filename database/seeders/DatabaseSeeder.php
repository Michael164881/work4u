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
            AdminSeeder::class,
            BookingSeeder::class,
            CustomerSeeder::class,
            EWalletSeeder::class,
            FreelancerSeeder::class,
            JobRequestSeeder::class,
            NotificationSeeder::class,
            WorkDescriptionSeeder::class,
            WorkProfileSeeder::class,
            PaymentSeeder::class,
    ]);
    }
}
