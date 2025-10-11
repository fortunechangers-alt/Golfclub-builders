<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBlockedDatesTable extends Migration
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
            'date' => [
                'type' => 'DATE',
            ],
            'start_time' => [
                'type' => 'TIME',
                'null' => true,
                'comment' => 'Null for full day block',
            ],
            'end_time' => [
                'type' => 'TIME',
                'null' => true,
                'comment' => 'Null for full day block',
            ],
            'reason' => [
                'type'       => 'ENUM',
                'constraint' => ['vacation', 'maintenance', 'holiday', 'other'],
                'default'    => 'other',
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'is_recurring' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'recurrence_pattern' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
                'comment'    => 'e.g., weekly, monthly, day_of_week',
            ],
            'created_by_admin_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
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
        $this->forge->addForeignKey('created_by_admin_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('blocked_dates');
    }

    public function down()
    {
        $this->forge->dropTable('blocked_dates');
    }
}
