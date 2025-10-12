<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Debug extends BaseController
{
    public function testOrder()
    {
        // Test order processing without actual database insert
        $testData = [
            'email' => 'test@example.com',
            'phone' => '7173871643',
            'name' => 'Test User',
            'order_data' => json_encode([
                [
                    'id' => 'test_item',
                    'name' => 'Test Service',
                    'price' => 50,
                    'quantity' => 1
                ]
            ]),
            'total_amount' => 53.00,
            'emergency_mode' => false
        ];

        $checks = [
            'PHP Version' => phpversion(),
            'CodeIgniter Version' => \CodeIgniter\CodeIgniter::CI_VERSION,
            'Environment' => ENVIRONMENT,
            'Database exists' => class_exists('App\Models\OrderModel') ? 'Yes' : 'No',
            'EmailService exists' => class_exists('App\Libraries\EmailService') ? 'Yes' : 'No',
            'Writable directory' => is_writable(WRITEPATH) ? 'Yes' : 'No',
            'Logs directory' => is_writable(WRITEPATH . 'logs') ? 'Yes' : 'No',
            'Test data' => $testData
        ];

        return $this->response->setJSON([
            'status' => 'Debug Info',
            'checks' => $checks,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }
    
    public function checkEmail()
    {
        $test = [
            'mail_function_exists' => function_exists('mail'),
            'email_config' => config('Email')
        ];
        
        return $this->response->setJSON($test);
    }
}
