<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AiFitting extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'AI Club & Shaft Fitting',
            'fitting_services' => $this->getFittingServices(),
            'repair_services' => $this->getRepairServices()
        ];
        
        return view('layout/header', $data)
             . view('ai-fitting/index', $data)
             . view('layout/footer', $data);
    }
    
    private function getFittingServices()
    {
        return [
            [
                'id' => 'basic_fitting',
                'name' => 'Basic Fitting',
                'description' => 'Shaft flex and grip size fitting services',
                'price' => 75.00,
                'duration' => '90 minutes',
                'includes' => [
                    'Swing speed analysis',
                    'Shaft flex determination (L, A/M, R, S, X, TX)',
                    'Grip size recommendation',
                    'Basic shaft brand suggestions'
                ]
            ],
            [
                'id' => 'premium_fitting',
                'name' => 'Premium Fitting',
                'description' => 'Complete fitting with custom specifications',
                'price' => 150.00,
                'duration' => '2 hours',
                'includes' => [
                    'Everything in Basic Fitting',
                    'Custom length adjustment',
                    'Lie angle optimization',
                    'Swing weight analysis',
                    'Detailed shaft brand/model recommendations',
                    'Complete build plan'
                ]
            ]
        ];
    }
    
    private function getRepairServices()
    {
        return [
            [
                'id' => 'loft_lie_adjustment',
                'name' => 'Loft/Lie Adjustment',
                'description' => 'Adjust club loft and lie angles',
                'price' => 6.00,
                'unit' => 'per club',
                'set_price' => 40.00,
                'set_unit' => '8-club set'
            ],
            [
                'id' => 'swing_weight_standard',
                'name' => 'Swing Weight - Standard',
                'description' => 'Adjust swing weight using standard methods',
                'price' => 10.00,
                'unit' => 'per club'
            ],
            [
                'id' => 'swing_weight_premium',
                'name' => 'Swing Weight - Premium (Tour Lock)',
                'description' => 'Adjust swing weight using Tour Lock system',
                'price' => 10.00,
                'unit' => 'per club + product cost'
            ],
            [
                'id' => 'shorten_shaft',
                'name' => 'Shorten Shaft',
                'description' => 'Cut shaft to desired length (labor only)',
                'price' => 6.00,
                'unit' => 'per club'
            ],
            [
                'id' => 'lengthen_shaft',
                'name' => 'Lengthen Shaft (Labor Only)',
                'description' => 'Add extension to shaft (extension + grip extra)',
                'price' => 6.00,
                'unit' => 'per club'
            ],
            [
                'id' => 'lengthen_shaft_with_grip',
                'name' => 'Lengthen Shaft (With Basic Grip)',
                'description' => 'Add extension and install basic grip',
                'price' => 16.00,
                'unit' => 'per club'
            ],
            [
                'id' => 'shaft_pull_adapter',
                'name' => 'Shaft Pull - Adapter Only',
                'description' => 'Remove shaft from adapter',
                'price' => 8.00,
                'unit' => 'per adapter'
            ],
            [
                'id' => 'reinstall_shaft',
                'name' => 'Reinstall Shaft',
                'description' => 'Reset loose head with new epoxy',
                'price' => 15.00,
                'unit' => 'per club'
            ],
            [
                'id' => 'install_adapter',
                'name' => 'Install New Shaft Adapter',
                'description' => 'Install new shaft adapter (adapter cost extra)',
                'price' => 24.00,
                'unit' => 'per adapter'
            ]
        ];
    }
}
