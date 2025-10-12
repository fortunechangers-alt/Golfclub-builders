<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'order_number',
        'customer_email',
        'customer_phone',
        'customer_name',
        'order_data',
        'total',
        'emergency_mode',
        'status',
        'created_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'order_number' => 'required|is_unique[orders.order_number]',
        'customer_email' => 'required|valid_email',
        'customer_phone' => 'required',
        'order_data' => 'required',
        'total' => 'required|decimal'
    ];

    protected $validationMessages = [
        'order_number' => [
            'required' => 'Order number is required',
            'is_unique' => 'Order number must be unique'
        ],
        'customer_email' => [
            'required' => 'Customer email is required',
            'valid_email' => 'Please provide a valid email address'
        ],
        'customer_phone' => [
            'required' => 'Customer phone number is required'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = ['generateOrderNumber'];
    protected $afterInsert = ['sendOrderEmails'];

    protected function generateOrderNumber(array $data)
    {
        // Generate unique order number: GC-YYYYMMDD-XXXX
        $date = date('Ymd');
        $random = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $data['data']['order_number'] = 'GC-' . $date . '-' . $random;
        
        return $data;
    }

    protected function sendOrderEmails(array $data)
    {
        // This will be handled in the controller to avoid circular dependencies
        return $data;
    }
}