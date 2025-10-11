<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBusinessHoursTable extends Migration
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
            'day_of_week' => [
                'type'       => 'INT',
                'constraint' => 1,
                'comment'    => '0=Sunday, 1=Monday, ..., 6=Saturday',
            ],
            'is_open' => [
                'type'    => 'BOOLEAN',
                'default' => true,
            ],
            'open_time' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'close_time' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'max_bookings_per_day' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 10,
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
        $this->forge->createTable('business_hours');
    }

    public function down()
    {
        $this->forge->dropTable('business_hours');
    }
}
