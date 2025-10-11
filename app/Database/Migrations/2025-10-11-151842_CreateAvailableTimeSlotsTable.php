<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAvailableTimeSlotsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'service_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'comment'    => 'Which service this slot is for',
            ],
            'date' => [
                'type'    => 'DATE',
                'comment' => 'The date this slot is available',
            ],
            'start_time' => [
                'type'    => 'TIME',
                'comment' => 'Start time of the slot',
            ],
            'end_time' => [
                'type'    => 'TIME',
                'comment' => 'End time of the slot',
            ],
            'max_bookings' => [
                'type'       => 'INT',
                'constraint' => 3,
                'default'    => 1,
                'comment'    => 'How many bookings can use this slot (usually 1)',
            ],
            'current_bookings' => [
                'type'       => 'INT',
                'constraint' => 3,
                'default'    => 0,
                'comment'    => 'How many bookings currently using this slot',
            ],
            'is_active' => [
                'type'    => 'BOOLEAN',
                'default' => true,
                'comment' => 'Can be turned off without deleting',
            ],
            'notes' => [
                'type'    => 'TEXT',
                'null'    => true,
                'comment' => 'Admin notes about this slot',
            ],
            'created_by_admin_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'comment'    => 'Which admin created this slot',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addKey(['date', 'start_time']); // Index for quick lookups
        $this->forge->addForeignKey('service_id', 'services', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('created_by_admin_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('available_time_slots');
    }

    public function down()
    {
        $this->forge->dropTable('available_time_slots');
    }
}
