<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $customer_seed = [
            ['id' => '1', 
            'cust_id' => '840517130566', 
            'cust_name' => 'Ah Beng', 
            'cust_gender' => 'M', 
            'cust_age' => '40', 
            'cust_email' => 'ahbeng123@gmail.com', 
            'cust_phone_no' => '01235876421', 
            'cust_password' => 'ahbeng123', 
            'cust_location' => '1st Floor, Lot 115, Lorong 5A, Jalan Abdul Rahim, Jalan Cheras, 40450 Shah Alam, Selangor.'],
        ];

        foreach ($customer_seed as $seed) {
            Customer::firstOrCreate($seed);
        }
    }
}
