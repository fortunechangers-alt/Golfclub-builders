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
                'iron_install' => ['standard' => 21.99, 'rush' => 32.99],
                'metalwood_install' => ['standard' => 24.99, 'rush' => 37.49],
                'adapter_install' => ['standard' => 17.99, 'rush' => 26.99],
                'polishing' => ['standard' => 20.00, 'rush' => 30.00]
            ],
            'regrips' => [
                'grip_install_bring' => ['standard' => 3.99, 'rush' => 5.99],
                'grip_install_with' => ['standard' => 3.99, 'rush' => 5.99],
                'save_reinstall' => ['standard' => 7.99, 'rush' => 11.99]
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
