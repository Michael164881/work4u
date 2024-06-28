<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaskChecklist;
use Illuminate\Support\Facades\DB;

class TaskChecklistsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookings = [
            ['id' => 1, 'created_at' => '2024-06-27 10:47:08', 'updated_at' => '2024-06-27 10:47:08', 'user_id' => 8, 'job_request_id' => 0, 'work_profile_id' => 7, 'booking_status' => 'pending', 'notification_id' => null, 'booking_start_date' => '2024-06-27 10:47:08', 'booking_end_date' => '2024-07-02 10:47:08', 'booking_fee' => 300.00],
            ['id' => 2, 'created_at' => '2024-06-27 10:47:23', 'updated_at' => '2024-06-27 10:47:23', 'user_id' => 8, 'job_request_id' => 0, 'work_profile_id' => 3, 'booking_status' => 'pending', 'notification_id' => null, 'booking_start_date' => '2024-06-27 10:47:23', 'booking_end_date' => '2024-07-07 10:47:23', 'booking_fee' => 500.00],
            ['id' => 3, 'created_at' => '2024-06-27 12:24:46', 'updated_at' => '2024-06-27 12:24:46', 'user_id' => 8, 'job_request_id' => 0, 'work_profile_id' => 1, 'booking_status' => 'pending', 'notification_id' => null, 'booking_start_date' => '2024-06-27 12:24:46', 'booking_end_date' => '2024-07-27 12:24:46', 'booking_fee' => 1500.00],
            ['id' => 4, 'created_at' => '2024-06-27 12:34:48', 'updated_at' => '2024-06-27 12:34:48', 'user_id' => 8, 'job_request_id' => 0, 'work_profile_id' => 4, 'booking_status' => 'pending', 'notification_id' => null, 'booking_start_date' => '2024-06-27 12:34:48', 'booking_end_date' => '2024-07-17 12:34:48', 'booking_fee' => 800.00],
        ];

        // Define some sample checklist descriptions
        $checklistDescriptions = [
            'Initial client meeting',
            'Requirement analysis',
            'Design approval',
            'Development',
            'Testing and QA',
            'Final review',
            'Project delivery',
            'Post-delivery support',
        ];

        // Insert task checklists for each booking
        foreach ($bookings as $booking) {
            $numberOfTasks = rand(1, 5); // Each booking will have between 1 to 5 tasks
            for ($i = 0; $i < $numberOfTasks; $i++) {
                DB::table('task_checklists')->insert([
                    'booking_id' => $booking['id'],
                    'checklist_description' => $checklistDescriptions[array_rand($checklistDescriptions)],
                    'status' => ['pending', 'completed', 'failed'][array_rand(['pending', 'completed', 'failed'])],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
