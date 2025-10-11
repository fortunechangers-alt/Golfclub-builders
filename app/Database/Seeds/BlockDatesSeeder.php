<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BlockDatesSeeder extends Seeder
{
    public function run()
    {
        // Block specific dates
        // Edit this array to add your own vacation days, holidays, etc.
        
        $blockedDates = [
            // Example: Block Thanksgiving week
            [
                'date' => '2025-11-23',
                'start_time' => null,  // null = block full day
                'end_time' => null,
                'reason' => 'holiday',
                'notes' => 'Thanksgiving Week - Closed',
                'is_recurring' => 0,
                'recurrence_pattern' => null,
                'created_by_admin_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'date' => '2025-11-24',
                'start_time' => null,
                'end_time' => null,
                'reason' => 'holiday',
                'notes' => 'Thanksgiving Week - Closed',
                'is_recurring' => 0,
                'recurrence_pattern' => null,
                'created_by_admin_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'date' => '2025-11-25',
                'start_time' => null,
                'end_time' => null,
                'reason' => 'holiday',
                'notes' => 'Thanksgiving Day - Closed',
                'is_recurring' => 0,
                'recurrence_pattern' => null,
                'created_by_admin_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            
            // Christmas holidays
            [
                'date' => '2025-12-24',
                'start_time' => null,
                'end_time' => null,
                'reason' => 'holiday',
                'notes' => 'Christmas Eve - Closed',
                'is_recurring' => 0,
                'recurrence_pattern' => null,
                'created_by_admin_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'date' => '2025-12-25',
                'start_time' => null,
                'end_time' => null,
                'reason' => 'holiday',
                'notes' => 'Christmas Day - Closed',
                'is_recurring' => 0,
                'recurrence_pattern' => null,
                'created_by_admin_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            
            // Example: Block specific hours (lunch break on Oct 20)
            [
                'date' => '2025-10-20',
                'start_time' => '12:00:00',  // Block only 12 PM - 1 PM
                'end_time' => '13:00:00',
                'reason' => 'other',
                'notes' => 'Lunch break',
                'is_recurring' => 0,
                'recurrence_pattern' => null,
                'created_by_admin_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            
            // Add your own dates below:
            // [
            //     'date' => '2025-11-01',
            //     'start_time' => null,
            //     'end_time' => null,
            //     'reason' => 'vacation',  // vacation, maintenance, holiday, other
            //     'notes' => 'Your note here',
            //     'is_recurring' => 0,
            //     'recurrence_pattern' => null,
            //     'created_by_admin_id' => 1,
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s')
            // ],
        ];
        
        $this->db->table('blocked_dates')->insertBatch($blockedDates);
        
        echo "\n✅ SUCCESS! Blocked " . count($blockedDates) . " dates.\n";
        echo "View them at: http://localhost:8080/admin/calendar\n\n";
    }
}

