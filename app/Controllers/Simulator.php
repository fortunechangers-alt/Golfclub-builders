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
            // Weekday Daytime (9am-5pm)
            'weekday_day_hourly' => 20.00,
            'weekday_day_4hr' => 75.00,
            'weekday_day_8hr' => 140.00,
            
            // Weekday Evening (5pm-close)
            'weekday_evening_hourly' => 40.00,
            'weekday_evening_4hr' => 140.00,
            'weekday_evening_8hr' => 250.00,
            
            // Weekend (All Day)
            'weekend_hourly' => 50.00,
            'weekend_4hr' => 175.00,
            'weekend_8hr' => 300.00,
            
            // Legacy fields for backwards compatibility
            'hourly' => 40.00,
            'half_day' => 140.00,
            'full_day' => 250.00,
            'half_day_hours' => 4,
            'full_day_hours' => 8
        ];
    }
}
