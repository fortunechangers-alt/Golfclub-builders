<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAvailableDatesTable extends Migration
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
                'type'    => 'DATE',
                'comment' => 'Available date for booking',
            ],
            'notes' => [
                'type'    => 'VARCHAR',
                'constraint' => '255',
                'null'    => true,
                'comment' => 'Optional admin notes',
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
                'comment'    => '1 = active, 0 = inactive',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('date');
        $this->forge->createTable('available_dates');
    }

    public function down()
    {
        $this->forge->dropTable('available_dates');
    }
}

