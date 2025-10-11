<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CustomClubBuilding extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Custom Club Building',
            'services' => $this->getClubBuildingServices(),
            'emergency_services' => $this->getEmergencyServices()
        ];
        
        return view('layout/header', $data)
             . view('custom-club-building/index', $data)
             . view('layout/footer', $data);
    }
    
    private function getClubBuildingServices()
    {
        return [
            'club_builds' => [
                [
                    'id' => 'iron_install',
                    'name' => 'Iron Shaft Installation',
                    'description' => 'Install head on new shaft for iron clubs',
                    'price' => 24.00,
                    'unit' => 'per club',
                    'category' => 'club_builds'
                ],
                [
                    'id' => 'metalwood_install',
                    'name' => 'Metalwood/Hybrid Installation',
                    'description' => 'Install head on new shaft for metalwoods and hybrids',
                    'price' => 28.00,
                    'unit' => 'per club',
                    'category' => 'club_builds'
                ],
                [
                    'id' => 'adapter_install',
                    'name' => 'Shaft Adapter Installation',
                    'description' => 'Install new shaft adapter (adapter cost extra)',
                    'price' => 24.00,
                    'unit' => 'per adapter',
                    'category' => 'club_builds'
                ],
                [
                    'id' => 'polishing',
                    'name' => 'Old Club Polishing',
                    'description' => 'Cosmetic clean and polish of old clubs',
                    'price' => 20.00,
                    'unit' => 'per club',
                    'category' => 'club_builds'
                ]
            ],
            'regrips' => [
                [
                    'id' => 'grip_install_bring',
                    'name' => 'Grip Installation (Bring Your Grips)',
                    'description' => 'Install grips you provide',
                    'price' => 4.00,
                    'unit' => 'per club',
                    'category' => 'regrips'
                ],
                [
                    'id' => 'grip_install_with',
                    'name' => 'Grip Installation (With Grip Purchase)',
                    'description' => 'Install grips with grip purchase (grip cost extra)',
                    'price' => 4.00,
                    'unit' => 'per club + grip cost',
                    'category' => 'regrips'
                ],
                [
                    'id' => 'grip_save_reinstall',
                    'name' => 'Save & Reinstall Old Grip',
                    'description' => 'Remove and reinstall existing grip when salvageable',
                    'price' => 9.00,
                    'unit' => 'per club',
                    'category' => 'regrips'
                ]
            ],
            'grip_tiers' => [
                [
                    'name' => 'Basic',
                    'description' => 'Tour Velvet-style grips',
                    'price_range' => '$8-$12',
                    'id' => 'basic'
                ],
                [
                    'name' => 'Mid',
                    'description' => 'Multi-compound/Cord grips',
                    'price_range' => '$13-$19',
                    'id' => 'mid'
                ],
                [
                    'name' => 'Premium/Putter',
                    'description' => 'High-end grips',
                    'price_range' => '$20-$35+',
                    'id' => 'premium'
                ]
            ]
        ];
    }
    
    private function getEmergencyServices()
    {
        return [
            'emergency_repair' => [
                'name' => 'Emergency Repair Service',
                'description' => 'Same-day or next-day repair service with +50% labor charge',
                'rush_multiplier' => 1.5,
                'requires_call' => true,
                'call_message' => 'Must call to confirm appointment for same-day or close dates'
            ]
        ];
    }
}
