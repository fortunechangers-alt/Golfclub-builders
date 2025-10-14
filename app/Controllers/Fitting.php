<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Fitting extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Fitting',
            'flex_codes' => $this->getFlexCodes(),
            'repair_pricing' => $this->getRepairPricing()
        ];
        
        return view('layout/header', $data)
             . view('fitting/index', $data)
             . view('layout/footer', $data);
    }
    
    private function getFlexCodes()
    {
        return [
            'L' => ['name' => 'Ladies', 'description' => 'Lower speeds, smoother tempo'],
            'A' => ['name' => 'Senior', 'description' => 'Low-mid speeds, smooth tempo'],
            'M' => ['name' => 'Senior', 'description' => 'Low-mid speeds, smooth tempo'],
            'R' => ['name' => 'Regular', 'description' => 'Mid speeds or smooth-to-moderate tempo'],
            'S' => ['name' => 'Stiff', 'description' => 'Higher speeds and/or aggressive tempo'],
            'X' => ['name' => 'Extra Stiff', 'description' => 'Very high speeds, aggressive tempo'],
            'TX' => ['name' => 'Tour Extra', 'description' => 'Tour-level speed & tempo; only if S/X is under-loading']
        ];
    }
    
    private function getRepairPricing()
    {
        return [
            'loft_lie' => ['standard' => 5.00, 'rush' => 7.50, 'set_8' => [35, 52.50]],
            'swing_weight_standard' => ['standard' => 10.00, 'rush' => 15.00],
            'swing_weight_premium' => ['standard' => 10.00, 'rush' => 15.00, 'note' => 'Product price added'],
            'shorten_shaft' => ['standard' => 6.00, 'rush' => 9.00],
            'lengthen_shaft' => ['standard' => 6.00, 'rush' => 9.00, 'note' => 'Extension + grip extra'],
            'lengthen_with_grip' => ['standard' => 16.00, 'rush' => 24.00, 'note' => 'Grip included'],
            'shaft_pull' => ['standard' => 9.99, 'rush' => 14.99, 'note' => 'Remove from adapter'],
            'reinstall_shaft' => ['standard' => 15.00, 'rush' => 22.50, 'note' => 'Re-epoxy'],
            'adapter_install' => ['standard' => 17.99, 'rush' => 26.99, 'note' => 'Adapter extra']
        ];
    }
}
