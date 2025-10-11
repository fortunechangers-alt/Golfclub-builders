<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitialDataSeeder extends Seeder
{
    public function run()
    {
        // Seed Services
        $services = [
            [
                'name' => 'AI Club Fitting',
                'slug' => 'ai-club-fitting',
                'description' => 'Revolutionary AI technology analyzes your swing in real-time, providing data-driven recommendations for optimal club selection and customization.',
                'price' => 199.00,
                'duration' => 90,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Professional Regripping',
                'slug' => 'professional-regripping',
                'description' => 'Expert regripping services using premium grips. Improve your control and comfort with professionally installed grips tailored to your preferences.',
                'price' => 49.00,
                'duration' => 30,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Custom Club Building',
                'slug' => 'custom-club-building',
                'description' => 'Complete custom club building service from shaft selection to final assembly. Each club meticulously crafted to your exact specifications.',
                'price' => 299.00,
                'duration' => 120,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        
        $this->db->table('services')->insertBatch($services);
        
        // Seed Business Hours (Monday-Saturday: 9 AM - 6 PM, Sunday: Closed)
        $businessHours = [
            ['day_of_week' => 0, 'is_open' => 0, 'open_time' => null, 'close_time' => null, 'max_bookings_per_day' => 0],
            ['day_of_week' => 1, 'is_open' => 1, 'open_time' => '09:00:00', 'close_time' => '18:00:00', 'max_bookings_per_day' => 10],
            ['day_of_week' => 2, 'is_open' => 1, 'open_time' => '09:00:00', 'close_time' => '18:00:00', 'max_bookings_per_day' => 10],
            ['day_of_week' => 3, 'is_open' => 1, 'open_time' => '09:00:00', 'close_time' => '18:00:00', 'max_bookings_per_day' => 10],
            ['day_of_week' => 4, 'is_open' => 1, 'open_time' => '09:00:00', 'close_time' => '18:00:00', 'max_bookings_per_day' => 10],
            ['day_of_week' => 5, 'is_open' => 1, 'open_time' => '09:00:00', 'close_time' => '18:00:00', 'max_bookings_per_day' => 10],
            ['day_of_week' => 6, 'is_open' => 1, 'open_time' => '09:00:00', 'close_time' => '17:00:00', 'max_bookings_per_day' => 8]
        ];
        
        $this->db->table('business_hours')->insertBatch($businessHours);
        
        // Seed Admin User
        $adminUser = [
            'email' => 'admin@golfbuilders.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'first_name' => 'Admin',
            'last_name' => 'User',
            'phone' => '555-123-4567',
            'role' => 'admin',
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->table('users')->insert($adminUser);
        
        // Seed Sample Products
        $products = [
            [
                'name' => 'Golf Pride Tour Velvet Grip',
                'slug' => 'golf-pride-tour-velvet',
                'description' => 'The most popular grip in golf. Features a state-of-the-art rubber compound with non-slip surface pattern for maximum playability and confidence.',
                'price' => 8.99,
                'stock_quantity' => 100,
                'category' => 'Grips',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Lamkin Crossline Grip',
                'slug' => 'lamkin-crossline',
                'description' => 'A classic grip with a distinctive pattern that provides reliable traction. One of the most trusted grips in the game.',
                'price' => 6.99,
                'stock_quantity' => 80,
                'category' => 'Grips',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'SuperStroke S-Tech Cord Grip',
                'slug' => 'superstroke-stech-cord',
                'description' => 'Advanced grip with cross-traction surface texture and strategically placed cord material for added traction.',
                'price' => 9.99,
                'stock_quantity' => 60,
                'category' => 'Grips',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Graphite Design Tour AD Shaft',
                'slug' => 'graphite-design-tour-ad',
                'description' => 'Premium graphite shaft designed for tour players. Exceptional feel and performance.',
                'price' => 349.99,
                'stock_quantity' => 25,
                'category' => 'Shafts',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'True Temper Dynamic Gold Shaft',
                'slug' => 'true-temper-dynamic-gold',
                'description' => 'The most popular steel shaft on tour. Delivers consistent feel and performance.',
                'price' => 24.99,
                'stock_quantity' => 50,
                'category' => 'Shafts',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Golf Club Head Covers Set',
                'slug' => 'club-head-covers-set',
                'description' => 'Premium leather head covers for driver, fairway woods, and hybrids. Protect your investment in style.',
                'price' => 49.99,
                'stock_quantity' => 40,
                'category' => 'Accessories',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        
        $this->db->table('products')->insertBatch($products);
        
        // Seed Booking Settings
        $bookingSettings = [
            [
                'setting_key' => 'advance_notice_hours',
                'setting_value' => '24',
                'description' => 'Minimum hours notice required for booking',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'setting_key' => 'max_advance_booking_days',
                'setting_value' => '90',
                'description' => 'Maximum days in advance customers can book',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'setting_key' => 'time_slot_interval',
                'setting_value' => '30',
                'description' => 'Time slot interval in minutes',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'setting_key' => 'buffer_time',
                'setting_value' => '15',
                'description' => 'Buffer time between appointments in minutes',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        
        $this->db->table('booking_settings')->insertBatch($bookingSettings);
        
        // Seed Sample Testimonials
        $testimonials = [
            [
                'customer_name' => 'John Mitchell',
                'rating' => 5,
                'testimonial' => 'The AI fitting was incredible! I gained 20 yards with my driver and my accuracy improved dramatically. Best investment I\'ve made in my golf game.',
                'is_featured' => 1,
                'is_approved' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'customer_name' => 'Sarah Peterson',
                'rating' => 5,
                'testimonial' => 'Professional regripping service was quick and affordable. The new grips feel amazing and have really improved my control, especially in wet conditions.',
                'is_featured' => 1,
                'is_approved' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'customer_name' => 'Mike Rodriguez',
                'rating' => 5,
                'testimonial' => 'The team at Golf Builders really knows their stuff. The fitting process was thorough and the results speak for themselves. My scores have never been better!',
                'is_featured' => 1,
                'is_approved' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        
        $this->db->table('testimonials')->insertBatch($testimonials);
        
        echo "Sample data seeded successfully!\n";
        echo "Admin Login: admin@golfbuilders.com / admin123\n";
    }
}
