<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ClubBuilds extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Club Builds',
            'pricing' => $this->getPricingData()
        ];
        
        return view('layout/header', $data)
             . view('club-builds/index', $data)
             . view('layout/footer', $data);
    }
    
    private function getPricingData()
    {
        return [
            'club_builds' => [
                'iron_install' => ['standard' => 24.00, 'rush' => 36.00],
                'metalwood_install' => ['standard' => 28.00, 'rush' => 42.00],
                'adapter_install' => ['standard' => 24.00, 'rush' => 36.00],
                'polishing' => ['standard' => 20.00, 'rush' => 30.00]
            ],
            'regrips' => [
                'grip_install_bring' => ['standard' => 4.00, 'rush' => 6.00],
                'grip_install_with' => ['standard' => 4.00, 'rush' => 6.00],
                'save_reinstall' => ['standard' => 9.00, 'rush' => 13.50]
            ],
            'grip_tiers' => [
                'basic' => ['min' => 8, 'max' => 12, 'name' => 'Basic (Tour Velvet-style)'],
                'mid' => ['min' => 13, 'max' => 19, 'name' => 'Mid (Multi-compound/Cord)'],
                'premium' => ['min' => 20, 'max' => 35, 'name' => 'Premium/Putter']
            ],
            'rush_multiplier' => 1.5
        ];
    }
}
