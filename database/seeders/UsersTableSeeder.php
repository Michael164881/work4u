<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'ic' => '11111111',
            'name' => 'Admin Admin',
            'email' => 'admin@paper.com',
            'role' => 'admin',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $users = [
            [
                'ic' => '1234567890',
                'role' => 'freelancer',
                'name' => 'John Doe',
                'email' => 'johndoe@example.com',
                'phone_number' => '1234567890',
                'location' => 'Shah Alam',
                'password' => Hash::make('123456789'),
                'ewallet_balance' => '20.00',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ic' => '1234567891',
                'role' => 'freelancer',
                'name' => 'Jane Smith',
                'email' => 'janesmith@example.com',
                'phone_number' => '1234567891',
                'location' => 'Subang Jaya',
                'password' => Hash::make('123456789'),
                'ewallet_balance' => '00.00',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ic' => '1234567892',
                'role' => 'freelancer',
                'name' => 'Robert Brown',
                'email' => 'robertbrown@example.com',
                'phone_number' => '1234567892',
                'location' => 'Kuala Lumpur',
                'password' => Hash::make('123456789'),
                'ewallet_balance' => '100.00',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ic' => '1234567893',
                'role' => 'freelancer',
                'name' => 'Emily Johnson',
                'email' => 'emilyjohnson@example.com',
                'phone_number' => '1234567893',
                'location' => 'Klang',
                'password' => Hash::make('123456789'),
                'ewallet_balance' => '50.00',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ic' => '1234567894',
                'role' => 'freelancer',
                'name' => 'Michael White',
                'email' => 'michaelwhite@example.com',
                'phone_number' => '1234567894',
                'location' => 'Shah Alam',
                'password' => Hash::make('123456789'),
                'ewallet_balance' => '200.00',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ic' => '1234567895',
                'role' => 'freelancer',
                'name' => 'Sarah Miller',
                'email' => 'sarahmiller@example.com',
                'phone_number' => '1234567895',
                'location' => 'Klang',
                'password' => Hash::make('password'),
                'ewallet_balance' => '10.00',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ic' => '020420130601',
                'role' => 'customer',
                'name' => 'Michael John',
                'email' => 'michaeljohnjinap@gmail.com',
                'phone_number' => '0178562937',
                'location' => 'Shah Alam',
                'password' => Hash::make('123456789'),
                'ewallet_balance' => '200.00',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }

    }
}
