<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Frontend Routes
$routes->get('/', 'Home::index');

// Test route (temporary)
$routes->get('/test-block', 'TestBlockDate::index');

// Services
$routes->get('/services', 'Services::index');
$routes->get('/services/(:segment)', 'Services::view/$1');

// New Pages
$routes->get('/custom-club-building', 'CustomClubBuilding::index');
$routes->get('/ai-fitting', 'AiFitting::index');
$routes->get('/fitting', 'AiFitting::index'); // Alias for menu compatibility
$routes->get('/simulator', 'Simulator::index');
$routes->get('/blog', 'Blog::index');
$routes->get('/blog/(:segment)', 'Blog::view/$1');

// Cart functionality
$routes->get('/cart', 'Cart::index');
$routes->post('/cart/add', 'Cart::add');
$routes->post('/cart/remove', 'Cart::remove');
$routes->post('/cart/update', 'Cart::update');
$routes->post('/cart/process-order', 'Cart::processOrder');
// Removed duplicate checkout routes - using cart system instead

// Booking
$routes->get('/booking', 'Booking::index');
$routes->post('/booking/create', 'Booking::create');
$routes->get('/booking/confirmation/(:segment)', 'Booking::confirmation/$1');
$routes->get('/booking/checkAvailability', 'Booking::checkAvailability');

// API Routes
$routes->get('/api/available-dates', 'Api\AvailableDates::index');

// Shop
$routes->get('/shop', 'Shop::index');
$routes->get('/shop/(:segment)', 'Shop::view/$1');
$routes->get('/checkout', 'Shop::checkout');
$routes->post('/checkout/process', 'Shop::processCheckout');

// Static Pages
$routes->get('/about', 'Pages::about');
$routes->get('/contact', 'Pages::contact');
$routes->post('/contact/submit', 'Pages::contactSubmit');
$routes->get('/testimonials', 'Testimonials::index');

// Authentication - Using CodeIgniter Shield
// Temporarily disabled due to service loading issue
// service('auth')->routes($routes);

// Manual authentication routes (temporary fix)
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::attemptLogin');
$routes->get('/logout', 'Auth::logout');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::attemptRegister');

// View Toggle (Admin only)
$routes->get('/toggle-view', 'ToggleView::toggle');

// Admin Panel (Protected by Shield Authentication and Admin Filter)
$routes->group('admin', ['filter' => 'admin'], function($routes) {
    $routes->get('/', 'Admin\Dashboard::index');
    $routes->get('dashboard', 'Admin\Dashboard::index');
    
    // Bookings Management
    $routes->get('bookings', 'Admin\Bookings::index');
    $routes->get('bookings/view/(:num)', 'Admin\Bookings::view/$1');
    $routes->post('bookings/update-status', 'Admin\Bookings::updateStatus');
    
    // Calendar Management
    $routes->get('calendar', 'Admin\Calendar::index');
    $routes->post('calendar/block', 'Admin\Calendar::blockDate');
    $routes->post('calendar/unblock', 'Admin\Calendar::unblockDate');
    
    // Available Dates Manager (Simple Date Control)
    $routes->get('available-dates-manager', 'Admin\AvailableDatesManager::index');
    $routes->get('available-dates-manager/create', 'Admin\AvailableDatesManager::create');
    $routes->post('available-dates-manager/store', 'Admin\AvailableDatesManager::store');
    $routes->get('available-dates-manager/bulk-create', 'Admin\AvailableDatesManager::bulkCreate');
    $routes->post('available-dates-manager/store-bulk', 'Admin\AvailableDatesManager::storeBulk');
    $routes->post('available-dates-manager/toggle-status/(:num)', 'Admin\AvailableDatesManager::toggleStatus/$1');
    $routes->post('available-dates-manager/delete/(:num)', 'Admin\AvailableDatesManager::delete/$1');
    
    // Available Time Slots Management (Soft Opening)
    $routes->get('available-slots', 'Admin\AvailableSlots::index');
    $routes->get('available-slots/create', 'Admin\AvailableSlots::create');
    $routes->post('available-slots/store', 'Admin\AvailableSlots::store');
    $routes->get('available-slots/quick-create', 'Admin\AvailableSlots::quickCreate');
    $routes->get('available-slots/toggle/(:num)', 'Admin\AvailableSlots::toggle/$1');
    $routes->get('available-slots/delete/(:num)', 'Admin\AvailableSlots::delete/$1');
    
    // Products Management
    $routes->get('products', 'Admin\Products::index');
    $routes->get('products/create', 'Admin\Products::create');
    $routes->post('products/store', 'Admin\Products::store');
    $routes->get('products/edit/(:num)', 'Admin\Products::edit/$1');
    $routes->post('products/update/(:num)', 'Admin\Products::update/$1');
    $routes->post('products/delete/(:num)', 'Admin\Products::delete/$1');
    
    // Orders Management
    $routes->get('orders', 'Admin\Orders::index');
    $routes->get('orders/view/(:num)', 'Admin\Orders::view/$1');
    
    // Settings
    $routes->get('settings', 'Admin\Settings::index');
    $routes->post('settings/update', 'Admin\Settings::update');
    
    // Business Hours
    $routes->get('business-hours', 'Admin\BusinessHours::index');
    $routes->post('business-hours/update', 'Admin\BusinessHours::update');
});
