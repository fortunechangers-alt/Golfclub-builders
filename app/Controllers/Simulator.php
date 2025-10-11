<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Simulator extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Simulator',
            'pricing' => $this->getPricingData()
        ];
        
        return view('layout/header', $data)
             . view('simulator/index', $data)
             . view('layout/footer', $data);
    }
    
    private function getPricingData()
    {
        return [
            'hourly' => 40.00,
            'half_day' => 140.00,
            'full_day' => 250.00,
            'half_day_hours' => 4,
            'full_day_hours' => 8
        ];
    }
}
