<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEmailFieldsToOrders extends Migration
{
    public function up()
    {
        $fields = [
            'order_data' => [
                'type' => 'TEXT',
                'comment' => 'JSON data of cart items',
                'null' => true,
            ],
            'emergency_mode' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
        ];
        
        $this->forge->addColumn('orders', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('orders', ['order_data', 'emergency_mode']);
    }
}
